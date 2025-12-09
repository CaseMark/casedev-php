<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\VaultContract;
use Casedev\Services\Vault\GraphragService;
use Casedev\Services\Vault\ObjectsService;
use Casedev\Vault\VaultCreateParams;
use Casedev\Vault\VaultIngestParams;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUploadParams;
use Casedev\Vault\VaultUploadResponse;

final class VaultService implements VaultContract
{
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
        $this->graphrag = new GraphragService($client);
        $this->objects = new ObjectsService($client);
    }

    /**
     * @api
     *
     * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional knowledge graph features for legal document analysis and discovery.
     *
     * @param array{
     *   name: string, description?: string, enableGraph?: bool
     * }|VaultCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|VaultCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): VaultNewResponse {
        [$parsed, $options] = VaultCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<VaultNewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'vault',
            body: (object) $parsed,
            options: $options,
            convert: VaultNewResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific vault, including storage configuration, chunking strategy, and usage statistics. Returns vault metadata, bucket information, and vector storage details.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: ['vault/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * List all vaults for the authenticated organization. Returns vault metadata including storage configuration and usage statistics.
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): VaultListResponse {
        /** @var BaseResponse<VaultListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'vault',
            options: $requestOptions,
            convert: VaultListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Triggers OCR ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. Processing happens asynchronously with GraphRAG support if enabled on the vault. Returns immediately with workflow tracking information.
     *
     * @param array{id: string}|VaultIngestParams $params
     *
     * @throws APIException
     */
    public function ingest(
        string $objectID,
        array|VaultIngestParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultIngestResponse {
        [$parsed, $options] = VaultIngestParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var BaseResponse<VaultIngestResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['vault/%1$s/ingest/%2$s', $id, $objectID],
            options: $options,
            convert: VaultIngestResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Search across vault documents using multiple methods including hybrid vector + graph search, GraphRAG global search, entity-based search, and fast similarity search. Returns relevant documents and contextual answers based on the search method.
     *
     * @param array{
     *   query: string,
     *   filters?: array<string,mixed>,
     *   method?: 'vector'|'graph'|'hybrid'|'global'|'local'|'fast'|'entity',
     *   topK?: int,
     * }|VaultSearchParams $params
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|VaultSearchParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultSearchResponse {
        [$parsed, $options] = VaultSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<VaultSearchResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['vault/%1$s/search', $id],
            body: (object) $parsed,
            options: $options,
            convert: VaultSearchResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Generate a presigned URL for uploading files directly to a vault's S3 storage. This endpoint creates a temporary upload URL that allows secure file uploads without exposing credentials. Files can be automatically indexed for semantic search or stored for manual processing.
     *
     * @param array{
     *   contentType: string,
     *   filename: string,
     *   auto_index?: bool,
     *   metadata?: mixed,
     *   sizeBytes?: float,
     * }|VaultUploadParams $params
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        array|VaultUploadParams $params,
        ?RequestOptions $requestOptions = null,
    ): VaultUploadResponse {
        [$parsed, $options] = VaultUploadParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<VaultUploadResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['vault/%1$s/upload', $id],
            body: (object) $parsed,
            options: $options,
            convert: VaultUploadResponse::class,
        );

        return $response->parse();
    }
}
