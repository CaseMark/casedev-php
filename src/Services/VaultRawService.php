<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\VaultRawContract;
use Casedev\Vault\VaultCreateParams;
use Casedev\Vault\VaultDeleteParams;
use Casedev\Vault\VaultDeleteResponse;
use Casedev\Vault\VaultGetResponse;
use Casedev\Vault\VaultIngestParams;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams;
use Casedev\Vault\VaultSearchParams\Filters;
use Casedev\Vault\VaultSearchParams\Method;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUpdateParams;
use Casedev\Vault\VaultUpdateResponse;
use Casedev\Vault\VaultUploadParams;
use Casedev\Vault\VaultUploadResponse;

/**
 * @phpstan-import-type FiltersShape from \Casedev\Vault\VaultSearchParams\Filters
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class VaultRawService implements VaultRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional GraphRAG knowledge graph features for legal document analysis and discovery.
     *
     * @param array{
     *   name: string,
     *   description?: string,
     *   enableGraph?: bool,
     *   enableIndexing?: bool,
     *   metadata?: mixed,
     * }|VaultCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'vault',
            body: (object) $parsed,
            options: $options,
            convert: VaultNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific vault, including storage configuration, chunking strategy, and usage statistics. Returns vault metadata, bucket information, and vector storage details.
     *
     * @param string $id Unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s', $id],
            options: $requestOptions,
            convert: VaultGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update vault settings including name, description, and enableGraph. Changing enableGraph only affects future document uploads - existing documents retain their current graph/non-graph state.
     *
     * @param string $id Vault ID to update
     * @param array{
     *   description?: string|null, enableGraph?: bool, name?: string
     * }|VaultUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|VaultUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: VaultUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * List all vaults for the authenticated organization. Returns vault metadata including name, description, storage configuration, and usage statistics.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'vault',
            options: $requestOptions,
            convert: VaultListResponse::class,
        );
    }

    /**
     * @api
     *
     * Permanently deletes a vault and all its contents including documents, vectors, graph data, and S3 buckets. This operation cannot be undone. For large vaults, use the async=true query parameter to queue deletion in the background.
     *
     * @param string $id Vault ID to delete
     * @param array{async?: bool}|VaultDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        array|VaultDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['vault/%1$s', $id],
            query: $parsed,
            options: $options,
            convert: VaultDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Triggers ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. For supported file types (PDF, DOCX, TXT, RTF, XML, audio, video), processing happens asynchronously. For unsupported types (images, archives, etc.), the file is marked as completed immediately without text extraction. GraphRAG indexing must be triggered separately via POST /vault/:id/graphrag/:objectId.
     *
     * @param string $objectID Vault object ID
     * @param array{id: string}|VaultIngestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultIngestParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/ingest/%2$s', $id, $objectID],
            options: $options,
            convert: VaultIngestResponse::class,
        );
    }

    /**
     * @api
     *
     * Search across vault documents using multiple methods including hybrid vector + graph search, GraphRAG global search, entity-based search, and fast similarity search. Returns relevant documents and contextual answers based on the search method.
     *
     * @param string $id Unique identifier of the vault to search
     * @param array{
     *   query: string,
     *   filters?: Filters|FiltersShape,
     *   method?: Method|value-of<Method>,
     *   topK?: int,
     * }|VaultSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/search', $id],
            body: (object) $parsed,
            options: $options,
            convert: VaultSearchResponse::class,
        );
    }

    /**
     * @api
     *
     * Generate a presigned URL for uploading files directly to a vault's S3 storage. This endpoint creates a temporary upload URL that allows secure file uploads without exposing credentials. Files can be automatically indexed for semantic search or stored for manual processing.
     *
     * @param string $id Vault ID to upload the file to
     * @param array{
     *   contentType: string,
     *   filename: string,
     *   autoIndex?: bool,
     *   metadata?: mixed,
     *   path?: string,
     *   sizeBytes?: int,
     * }|VaultUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultUploadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/upload', $id],
            body: (object) $parsed,
            options: $options,
            convert: VaultUploadResponse::class,
        );
    }
}
