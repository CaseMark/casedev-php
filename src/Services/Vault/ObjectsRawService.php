<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\ObjectsRawContract;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams\Operation;
use Casedev\Vault\Objects\ObjectDeleteParams;
use Casedev\Vault\Objects\ObjectDeleteParams\Force;
use Casedev\Vault\Objects\ObjectDeleteResponse;
use Casedev\Vault\Objects\ObjectDownloadParams;
use Casedev\Vault\Objects\ObjectGetOcrWordsParams;
use Casedev\Vault\Objects\ObjectGetOcrWordsResponse;
use Casedev\Vault\Objects\ObjectGetResponse;
use Casedev\Vault\Objects\ObjectGetSummarizeJobParams;
use Casedev\Vault\Objects\ObjectGetSummarizeJobResponse;
use Casedev\Vault\Objects\ObjectGetTextParams;
use Casedev\Vault\Objects\ObjectGetTextResponse;
use Casedev\Vault\Objects\ObjectListResponse;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;
use Casedev\Vault\Objects\ObjectRetrieveParams;
use Casedev\Vault\Objects\ObjectUpdateParams;
use Casedev\Vault\Objects\ObjectUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class ObjectsRawService implements ObjectsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves metadata for a specific document in a vault and generates a temporary download URL. The download URL expires after 1 hour for security. This endpoint also updates the file size if it wasn't previously calculated.
     *
     * @param string $objectID Object ID within the vault
     * @param array{id: string}|ObjectRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $objectID,
        array|ObjectRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects/%2$s', $id, $objectID],
            options: $options,
            convert: ObjectGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update a document's filename, path, or metadata. Use this to rename files or organize them into virtual folders. The path is stored in metadata.path and can be used to build folder hierarchies in your application.
     *
     * @param string $objectID Path param: Object ID to update
     * @param array{
     *   id: string, filename?: string, metadata?: mixed, path?: string|null
     * }|ObjectUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $objectID,
        array|ObjectUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/%1$s/objects/%2$s', $id, $objectID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ObjectUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve all objects stored in a specific vault, including document metadata, ingestion status, and processing statistics.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects', $id],
            options: $requestOptions,
            convert: ObjectListResponse::class,
        );
    }

    /**
     * @api
     *
     * Permanently deletes a document from the vault including all associated vectors, chunks, graph data, and the original file. This operation cannot be undone.
     *
     * @param string $objectID Path param: Object ID to delete
     * @param array{
     *   id: string, force?: Force|value-of<Force>
     * }|ObjectDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $objectID,
        array|ObjectDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['vault/%1$s/objects/%2$s', $id, $objectID],
            query: $parsed,
            options: $options,
            convert: ObjectDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Generate presigned URLs for direct S3 operations (GET, PUT, DELETE, HEAD) on vault objects. This allows secure, time-limited access to files without proxying through the API. Essential for large document uploads/downloads in legal workflows.
     *
     * @param string $objectID Path param: The unique identifier of the object
     * @param array{
     *   id: string,
     *   contentType?: string,
     *   expiresIn?: int,
     *   operation?: Operation|value-of<Operation>,
     *   sizeBytes?: int,
     * }|ObjectCreatePresignedURLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectNewPresignedURLResponse>
     *
     * @throws APIException
     */
    public function createPresignedURL(
        string $objectID,
        array|ObjectCreatePresignedURLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectCreatePresignedURLParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/objects/%2$s/presigned-url', $id, $objectID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ObjectNewPresignedURLResponse::class,
        );
    }

    /**
     * @api
     *
     * Downloads a file from a vault. Returns the actual file content as a binary stream with appropriate headers for file download. Useful for retrieving contracts, depositions, case files, and other legal documents stored in your vault.
     *
     * @param string $objectID Object ID within the vault
     * @param array{id: string}|ObjectDownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $objectID,
        array|ObjectDownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectDownloadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects/%2$s/download', $id, $objectID],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Retrieves word-level OCR bounding box data for a processed PDF document. Each word includes its text, normalized bounding box coordinates (0-1 range), confidence score, and global word index. Use this data to highlight specific text ranges in a PDF viewer based on word indices from search results.
     *
     * @param string $objectID Path param: The object ID
     * @param array{
     *   id: string, page?: int, wordEnd?: int, wordStart?: int
     * }|ObjectGetOcrWordsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectGetOcrWordsResponse>
     *
     * @throws APIException
     */
    public function getOcrWords(
        string $objectID,
        array|ObjectGetOcrWordsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectGetOcrWordsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects/%2$s/ocr-words', $id, $objectID],
            query: $parsed,
            options: $options,
            convert: ObjectGetOcrWordsResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the status of a CaseMark summary workflow job. If the job has been processing for too long, this endpoint will poll CaseMark directly to recover stuck jobs.
     *
     * @param string $jobID CaseMark job ID
     * @param array{id: string, objectID: string}|ObjectGetSummarizeJobParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectGetSummarizeJobResponse>
     *
     * @throws APIException
     */
    public function getSummarizeJob(
        string $jobID,
        array|ObjectGetSummarizeJobParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectGetSummarizeJobParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);
        $objectID = $parsed['objectID'];
        unset($parsed['objectID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects/%2$s/summarize/%3$s', $id, $objectID, $jobID],
            options: $options,
            convert: ObjectGetSummarizeJobResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieves the full extracted text content from a processed vault object. Returns the concatenated text from all chunks, useful for document review, analysis, or export. The object must have completed processing before text can be retrieved.
     *
     * @param string $objectID The object ID
     * @param array{id: string}|ObjectGetTextParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ObjectGetTextResponse>
     *
     * @throws APIException
     */
    public function getText(
        string $objectID,
        array|ObjectGetTextParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ObjectGetTextParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/objects/%2$s/text', $id, $objectID],
            options: $options,
            convert: ObjectGetTextResponse::class,
        );
    }
}
