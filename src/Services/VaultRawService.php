<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\VaultRawContract;
use Casedev\Vault\VaultCreateParams;
use Casedev\Vault\VaultIngestParams;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams;
use Casedev\Vault\VaultSearchParams\Method;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUploadParams;
use Casedev\Vault\VaultUploadResponse;

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
     *   name: string, description?: string, enableGraph?: bool
     * }|VaultCreateParams $params
     *
     * @return BaseResponse<VaultNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        ?RequestOptions $requestOptions = null
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
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all vaults for the authenticated organization. Returns vault metadata including name, description, storage configuration, and usage statistics.
     *
     * @return BaseResponse<VaultListResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse
    {
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
     * Triggers OCR ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. Processing happens asynchronously with GraphRAG support if enabled on the vault. Returns immediately with workflow tracking information.
     *
     * @param string $objectID Vault object ID
     * @param array{id: string}|VaultIngestParams $params
     *
     * @return BaseResponse<VaultIngestResponse>
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        ?RequestOptions $requestOptions = null,
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
     *   filters?: array{objectID?: string|list<string>},
     *   method?: 'vector'|'graph'|'hybrid'|'global'|'local'|'fast'|'entity'|Method,
     *   topK?: int,
     * }|VaultSearchParams $params
     *
     * @return BaseResponse<VaultSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        ?RequestOptions $requestOptions = null,
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
     *   relativePath?: string,
     *   sizeBytes?: float,
     * }|VaultUploadParams $params
     *
     * @return BaseResponse<VaultUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        ?RequestOptions $requestOptions = null,
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
