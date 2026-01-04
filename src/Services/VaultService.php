<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\VaultContract;
use Casedev\Services\Vault\GraphragService;
use Casedev\Services\Vault\ObjectsService;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams\Method;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUploadResponse;

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
    public ObjectsService $objects;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VaultRawService($client);
        $this->graphrag = new GraphragService($client);
        $this->objects = new ObjectsService($client);
    }

    /**
     * @api
     *
     * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional GraphRAG knowledge graph features for legal document analysis and discovery.
     *
     * @param string $name Display name for the vault
     * @param string $description Optional description of the vault's purpose
     * @param bool $enableGraph Enable knowledge graph for entity relationship mapping
     * @param mixed $metadata Optional metadata to attach to the vault (e.g., { containsPHI: true } for HIPAA compliance tracking)
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        bool $enableGraph = true,
        mixed $metadata = null,
        ?RequestOptions $requestOptions = null,
    ): VaultNewResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'description' => $description,
                'enableGraph' => $enableGraph,
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
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all vaults for the authenticated organization. Returns vault metadata including name, description, storage configuration, and usage statistics.
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): VaultListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Triggers OCR ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. Processing happens asynchronously with GraphRAG support if enabled on the vault. Returns immediately with workflow tracking information.
     *
     * @param string $objectID Vault object ID
     * @param string $id Vault ID
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        string $id,
        ?RequestOptions $requestOptions = null
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
     * @param array{
     *   objectID?: string|list<string>
     * } $filters Filters to narrow search results to specific documents
     * @param 'vector'|'graph'|'hybrid'|'global'|'local'|'fast'|'entity'|Method $method Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach
     * @param int $topK Maximum number of results to return
     *
     * @throws APIException
     */
    public function search(
        string $id,
        string $query,
        ?array $filters = null,
        string|Method $method = 'hybrid',
        int $topK = 10,
        ?RequestOptions $requestOptions = null,
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
     * Generate a presigned URL for uploading files directly to a vault's S3 storage. This endpoint creates a temporary upload URL that allows secure file uploads without exposing credentials. Files can be automatically indexed for semantic search or stored for manual processing.
     *
     * @param string $id Vault ID to upload the file to
     * @param string $contentType MIME type of the file (e.g., application/pdf, image/jpeg)
     * @param string $filename Name of the file to upload
     * @param bool $autoIndex Whether to automatically process and index the file for search
     * @param mixed $metadata Additional metadata to associate with the file
     * @param string $path Optional folder path for hierarchy preservation. Allows integrations to maintain source folder structure from systems like NetDocs, Clio, or Smokeball. Example: '/Discovery/Depositions/2024'
     * @param float $sizeBytes Estimated file size in bytes for cost calculation
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
        ?float $sizeBytes = null,
        ?RequestOptions $requestOptions = null,
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
