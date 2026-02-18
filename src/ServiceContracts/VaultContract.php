<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
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
interface VaultContract
{
    /**
     * @api
     *
     * @param string $name Display name for the vault
     * @param string $description Optional description of the vault's purpose
     * @param bool $enableGraph Enable knowledge graph for entity relationship mapping. Only applies when enableIndexing is true.
     * @param bool $enableIndexing Enable vector indexing and search capabilities. Set to false for storage-only vaults.
     * @param string $groupID Assign the vault to a vault group for access control. Required when using a group-scoped API key.
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
        ?string $groupID = null,
        mixed $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultNewResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): VaultGetResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to update
     * @param string|null $description New description for the vault. Set to null to remove.
     * @param bool $enableGraph Whether to enable GraphRAG for future document uploads
     * @param string|null $groupID move the vault to a different group, or set to null to remove from its current group
     * @param string $name New name for the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $groupID = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): VaultUpdateResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): VaultListResponse;

    /**
     * @api
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
    ): VaultDeleteResponse;

    /**
     * @api
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
    ): VaultConfirmUploadResponse;

    /**
     * @api
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
    ): VaultIngestResponse;

    /**
     * @api
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
    ): VaultUploadResponse;
}
