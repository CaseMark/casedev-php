<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\VaultContract;
use Casedev\Services\Vault\GraphragService;
use Casedev\Services\Vault\MultipartService;
use Casedev\Services\Vault\ObjectsService;
use Casedev\Vault\VaultConfirmUploadResponse;
use Casedev\Vault\VaultDeleteResponse;
use Casedev\Vault\VaultGetResponse;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams\Filters;
use Casedev\Vault\VaultSearchParams\Method;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUpdateResponse;
use Casedev\Vault\VaultUploadResponse;

/**
 * @phpstan-import-type FiltersShape from \Casedev\Vault\VaultSearchParams\Filters
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class VaultService implements VaultContract
{
    /**
     * @api
     */
    public VaultRawService $raw;

    /**
     * @api
     */
    public GraphragService $graphrag;

    /**
     * @api
     */
    public MultipartService $multipart;

    /**
     * @api
     */
    public ObjectsService $objects;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VaultRawService($client);
        $this->graphrag = new GraphragService($client);
        $this->multipart = new MultipartService($client);
        $this->objects = new ObjectsService($client);
    }

    /**
     * @api
     *
     * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional GraphRAG knowledge graph features for legal document analysis and discovery.
     *
     * @param string $name Display name for the vault
     * @param string $description Optional description of the vault's purpose
     * @param bool $enableGraph Enable knowledge graph for entity relationship mapping. Only applies when enableIndexing is true.
     * @param bool $enableIndexing Enable vector indexing and search capabilities. Set to false for storage-only vaults.
     * @param mixed $metadata Optional metadata to attach to the vault (e.g., { containsPHI: true } for HIPAA compliance tracking)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        bool $enableGraph = true,
        bool $enableIndexing = true,
        mixed $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultNewResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'description' => $description,
                'enableGraph' => $enableGraph,
                'enableIndexing' => $enableIndexing,
                'metadata' => $metadata,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific vault, including storage configuration, chunking strategy, and usage statistics. Returns vault metadata, bucket information, and vector storage details.
     *
     * @param string $id Unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): VaultGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update vault settings including name, description, and enableGraph. Changing enableGraph only affects future document uploads - existing documents retain their current graph/non-graph state.
     *
     * @param string $id Vault ID to update
     * @param string|null $description New description for the vault. Set to null to remove.
     * @param bool $enableGraph Whether to enable GraphRAG for future document uploads
     * @param string $name New name for the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultUpdateResponse {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'enableGraph' => $enableGraph,
                'name' => $name,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all vaults for the authenticated organization. Returns vault metadata including name, description, storage configuration, and usage statistics.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): VaultListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently deletes a vault and all its contents including documents, vectors, graph data, and S3 buckets. This operation cannot be undone. For large vaults, use the async=true query parameter to queue deletion in the background.
     *
     * @param string $id Vault ID to delete
     * @param bool $async If true and vault has many objects, queue deletion in background and return immediately
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        bool $async = false,
        RequestOptions|array|null $requestOptions = null,
    ): VaultDeleteResponse {
        $params = Util::removeNulls(['async' => $async]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Confirm whether a direct-to-S3 vault upload succeeded or failed. This endpoint emits vault.upload.completed or vault.upload.failed events and is idempotent for repeated confirmations.
     *
     * @param string $objectID Path param: Vault object ID
     * @param string $id Path param: Vault ID
     * @param bool $success Body param
     * @param string $errorCode Body param: Client-side error code (required when success=false)
     * @param string $errorMessage Body param: Client-side error message (required when success=false)
     * @param int $sizeBytes Body param: Uploaded file size in bytes (required when success=true)
     * @param string $etag Body param: S3 ETag for the uploaded object (optional if client cannot access ETag header)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirmUpload(
        string $objectID,
        string $id,
        bool $success,
        string $errorCode,
        string $errorMessage,
        ?int $sizeBytes = null,
        ?string $etag = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultConfirmUploadResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'sizeBytes' => $sizeBytes,
                'success' => $success,
                'errorCode' => $errorCode,
                'errorMessage' => $errorMessage,
                'etag' => $etag,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirmUpload($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Triggers ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. For supported file types (PDF, DOCX, TXT, RTF, XML, audio, video), processing happens asynchronously. For unsupported types (images, archives, etc.), the file is marked as completed immediately without text extraction. GraphRAG indexing must be triggered separately via POST /vault/:id/graphrag/:objectId.
     *
     * @param string $objectID Vault object ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): VaultIngestResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->ingest($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search across vault documents using multiple methods including hybrid vector + graph search, GraphRAG global search, entity-based search, and fast similarity search. Returns relevant documents and contextual answers based on the search method.
     *
     * @param string $id Unique identifier of the vault to search
     * @param string $query Search query or question to find relevant documents
     * @param Filters|FiltersShape $filters Filters to narrow search results to specific documents
     * @param Method|value-of<Method> $method Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach
     * @param int $topK Maximum number of results to return
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $id,
        string $query,
        Filters|array|null $filters = null,
        Method|string $method = 'hybrid',
        int $topK = 10,
        RequestOptions|array|null $requestOptions = null,
    ): VaultSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'filters' => $filters,
                'method' => $method,
                'topK' => $topK,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generate a presigned URL for uploading files directly to a vault's S3 storage. After uploading to S3, confirm the upload result via POST /vault/:vaultId/upload/:objectId/confirm before triggering ingestion.
     *
     * @param string $id Vault ID to upload the file to
     * @param string $contentType MIME type of the file (e.g., application/pdf, image/jpeg)
     * @param string $filename Name of the file to upload
     * @param bool $autoIndex Whether to automatically process and index the file for search
     * @param mixed $metadata Additional metadata to associate with the file
     * @param string $path Optional folder path for hierarchy preservation. Allows integrations to maintain source folder structure from systems like NetDocs, Clio, or Smokeball. Example: '/Discovery/Depositions/2024'
     * @param int $sizeBytes File size in bytes (optional, max 5GB for single PUT uploads). When provided, enforces exact file size at S3 level.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        string $contentType,
        string $filename,
        bool $autoIndex = true,
        mixed $metadata = null,
        ?string $path = null,
        ?int $sizeBytes = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultUploadResponse {
        $params = Util::removeNulls(
            [
                'contentType' => $contentType,
                'filename' => $filename,
                'autoIndex' => $autoIndex,
                'metadata' => $metadata,
                'path' => $path,
                'sizeBytes' => $sizeBytes,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
