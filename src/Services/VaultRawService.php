<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\ServiceContracts\VaultRawContract;
use Router\Vault\VaultConfirmUploadParams;
use Router\Vault\VaultConfirmUploadResponse;
use Router\Vault\VaultCreateParams;
use Router\Vault\VaultDeleteParams;
use Router\Vault\VaultDeleteResponse;
use Router\Vault\VaultGetResponse;
use Router\Vault\VaultIngestParams;
use Router\Vault\VaultIngestResponse;
use Router\Vault\VaultListResponse;
use Router\Vault\VaultNewResponse;
use Router\Vault\VaultSearchParams;
use Router\Vault\VaultSearchParams\Filters;
use Router\Vault\VaultSearchParams\Method;
use Router\Vault\VaultSearchResponse;
use Router\Vault\VaultUpdateParams;
use Router\Vault\VaultUpdateResponse;
use Router\Vault\VaultUploadParams;
use Router\Vault\VaultUploadResponse;

/**
 * @phpstan-import-type FiltersShape from \Router\Vault\VaultSearchParams\Filters
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
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
     *   groupID?: string,
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
     *   description?: string|null,
     *   enableGraph?: bool,
     *   groupID?: string|null,
     *   name?: string,
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
     * Confirm whether a direct-to-S3 vault upload succeeded or failed. This endpoint emits vault.upload.completed or vault.upload.failed events and is idempotent for repeated confirmations.
     *
     * @param string $objectID Path param: Vault object ID
     * @param array{
     *   id: string,
     *   sizeBytes: int,
     *   success: bool,
     *   etag?: string,
     *   errorCode: string,
     *   errorMessage: string,
     * }|VaultConfirmUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VaultConfirmUploadResponse>
     *
     * @throws APIException
     */
    public function confirmUpload(
        string $objectID,
        array|VaultConfirmUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VaultConfirmUploadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var array<string,mixed> */
        $body = $parsed['body'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/upload/%2$s/confirm', $id, $objectID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: VaultConfirmUploadResponse::class,
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
     * Generate a presigned URL for uploading files directly to a vault's S3 storage. After uploading to S3, confirm the upload result via POST /vault/:vaultId/upload/:objectId/confirm before triggering ingestion.
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
