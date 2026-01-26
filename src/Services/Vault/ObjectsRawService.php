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
use Casedev\Vault\Objects\ObjectDownloadParams;
use Casedev\Vault\Objects\ObjectGetResponse;
use Casedev\Vault\Objects\ObjectGetTextParams;
use Casedev\Vault\Objects\ObjectGetTextResponse;
use Casedev\Vault\Objects\ObjectListResponse;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;
use Casedev\Vault\Objects\ObjectRetrieveParams;

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
