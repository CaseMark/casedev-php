<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Vault;

use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Vault\Objects\ObjectCreatePresignedURLParams\Operation;
use Router\Vault\Objects\ObjectDeleteParams\Force;
use Router\Vault\Objects\ObjectDeleteResponse;
use Router\Vault\Objects\ObjectGetOcrWordsResponse;
use Router\Vault\Objects\ObjectGetResponse;
use Router\Vault\Objects\ObjectGetSummarizeJobResponse;
use Router\Vault\Objects\ObjectGetTextResponse;
use Router\Vault\Objects\ObjectListResponse;
use Router\Vault\Objects\ObjectNewPresignedURLResponse;
use Router\Vault\Objects\ObjectUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface ObjectsContract
{
    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectGetResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: Object ID to update
     * @param string $id Path param: Vault ID
     * @param string $filename Body param: New filename for the document (affects display name and downloads)
     * @param mixed $metadata Body param: Additional metadata to merge with existing metadata
     * @param string|null $path Body param: Folder path for hierarchy preservation (e.g., '/Discovery/Depositions'). Set to null or empty string to remove.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $objectID,
        string $id,
        ?string $filename = null,
        mixed $metadata = null,
        ?string $path = null,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectUpdateResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ObjectListResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: Object ID to delete
     * @param string $id Path param: Vault ID
     * @param Force|value-of<Force> $force Query param: Force delete a stuck document that is still in 'processing' state. Use this if a document got stuck during ingestion (e.g., OCR timeout).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $objectID,
        string $id,
        Force|string|null $force = null,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectDeleteResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: The unique identifier of the object
     * @param string $id Path param: The unique identifier of the vault
     * @param string $contentType Body param: Content type for PUT operations (optional, defaults to object's content type)
     * @param int $expiresIn Body param: URL expiration time in seconds (1 minute to 7 days)
     * @param Operation|value-of<Operation> $operation Body param: The S3 operation to generate URL for
     * @param int $sizeBytes Body param: File size in bytes (optional, max 5GB for single PUT uploads). When provided for PUT operations, enforces exact file size at S3 level.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createPresignedURL(
        string $objectID,
        string $id,
        ?string $contentType = null,
        int $expiresIn = 3600,
        Operation|string $operation = 'GET',
        ?int $sizeBytes = null,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectNewPresignedURLResponse;

    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @param string $objectID Path param: The object ID
     * @param string $id Path param: The vault ID
     * @param int $page Query param: Filter to a specific page number (1-indexed). If omitted, returns all pages.
     * @param int $wordEnd Query param: Filter to words ending at this index (inclusive). Useful for retrieving words for a specific chunk.
     * @param int $wordStart Query param: Filter to words starting at this index (inclusive). Useful for retrieving words for a specific chunk.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getOcrWords(
        string $objectID,
        string $id,
        ?int $page = null,
        ?int $wordEnd = null,
        ?int $wordStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectGetOcrWordsResponse;

    /**
     * @api
     *
     * @param string $jobID CaseMark job ID
     * @param string $id Vault ID
     * @param string $objectID Source object ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getSummarizeJob(
        string $jobID,
        string $id,
        string $objectID,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectGetSummarizeJobResponse;

    /**
     * @api
     *
     * @param string $objectID The object ID
     * @param string $id The vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getText(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): ObjectGetTextResponse;
}
