<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\ObjectsContract;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams\Operation;
use Casedev\Vault\Objects\ObjectGetResponse;
use Casedev\Vault\Objects\ObjectGetTextResponse;
use Casedev\Vault\Objects\ObjectListResponse;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Generate presigned URLs for direct S3 operations (GET, PUT, DELETE, HEAD) on vault objects. This allows secure, time-limited access to files without proxying through the API. Essential for large document uploads/downloads in legal workflows.
     *
     * @param string $objectID Path param: The unique identifier of the object
     * @param string $id Path param: The unique identifier of the vault
     * @param string $contentType Body param: Content type for PUT operations (optional, defaults to object's content type)
     * @param int $expiresIn Body param: URL expiration time in seconds (1 minute to 7 days)
     * @param Operation|value-of<Operation> $operation Body param: The S3 operation to generate URL for
     * @param int $sizeBytes Body param: File size in bytes (optional, max 500MB). When provided for PUT operations, enforces exact file size at S3 level.
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
