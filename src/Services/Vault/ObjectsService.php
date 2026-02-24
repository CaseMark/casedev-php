<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\ObjectsContract;
use CaseDev\Vault\Objects\ObjectCreatePresignedURLParams\Operation;
use CaseDev\Vault\Objects\ObjectDeleteParams\Force;
use CaseDev\Vault\Objects\ObjectDeleteResponse;
use CaseDev\Vault\Objects\ObjectGetOcrWordsResponse;
use CaseDev\Vault\Objects\ObjectGetResponse;
use CaseDev\Vault\Objects\ObjectGetSummarizeJobResponse;
use CaseDev\Vault\Objects\ObjectGetTextResponse;
use CaseDev\Vault\Objects\ObjectListResponse;
use CaseDev\Vault\Objects\ObjectNewPresignedURLResponse;
use CaseDev\Vault\Objects\ObjectUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class ObjectsService implements ObjectsContract
{
    /**
     * @api
     */
    public ObjectsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ObjectsRawService($client);
    }

    /**
     * @api
     *
     * Retrieves metadata for a specific document in a vault and generates a temporary download URL. The download URL expires after 1 hour for security. This endpoint also updates the file size if it wasn't previously calculated.
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
    ): ObjectGetResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a document's filename, path, or metadata. Use this to rename files or organize them into virtual folders. The path is stored in metadata.path and can be used to build folder hierarchies in your application.
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
    ): ObjectUpdateResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'filename' => $filename,
                'metadata' => $metadata,
                'path' => $path,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve all objects stored in a specific vault, including document metadata, ingestion status, and processing statistics.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ObjectListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently deletes a document from the vault including all associated vectors, chunks, graph data, and the original file. This operation cannot be undone.
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
    ): ObjectDeleteResponse {
        $params = Util::removeNulls(['id' => $id, 'force' => $force]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generate presigned URLs for direct S3 operations (GET, PUT, DELETE, HEAD) on vault objects. This allows secure, time-limited access to files without proxying through the API. Essential for large document uploads/downloads in legal workflows.
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
    ): ObjectNewPresignedURLResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'contentType' => $contentType,
                'expiresIn' => $expiresIn,
                'operation' => $operation,
                'sizeBytes' => $sizeBytes,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createPresignedURL($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Downloads a file from a vault. Returns the actual file content as a binary stream with appropriate headers for file download. Useful for retrieving contracts, depositions, case files, and other legal documents stored in your vault.
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
    ): string {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves word-level OCR bounding box data for a processed PDF document. Each word includes its text, normalized bounding box coordinates (0-1 range), confidence score, and global word index. Use this data to highlight specific text ranges in a PDF viewer based on word indices from search results.
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
    ): ObjectGetOcrWordsResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'page' => $page,
                'wordEnd' => $wordEnd,
                'wordStart' => $wordStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getOcrWords($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the status of a CaseMark summary workflow job.
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
    ): ObjectGetSummarizeJobResponse {
        $params = Util::removeNulls(['id' => $id, 'objectID' => $objectID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getSummarizeJob($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves the full extracted text content from a processed vault object. Returns the concatenated text from all chunks, useful for document review, analysis, or export. The object must have completed processing before text can be retrieved.
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
    ): ObjectGetTextResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getText($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
