<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\VaultIngestResponse;
use Casedev\Vault\VaultListResponse;
use Casedev\Vault\VaultNewResponse;
use Casedev\Vault\VaultSearchParams\Method;
use Casedev\Vault\VaultSearchResponse;
use Casedev\Vault\VaultUploadResponse;

interface VaultContract
{
    /**
     * @api
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
    ): VaultNewResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): VaultListResponse;

    /**
     * @api
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
    ): VaultIngestResponse;

    /**
     * @api
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
    ): VaultSearchResponse;

    /**
     * @api
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
    ): VaultUploadResponse;
}
