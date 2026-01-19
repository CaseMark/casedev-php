<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams\Operation;
use Casedev\Vault\Objects\ObjectGetResponse;
use Casedev\Vault\Objects\ObjectGetTextResponse;
use Casedev\Vault\Objects\ObjectListResponse;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * @param string $objectID Path param: The unique identifier of the object
     * @param string $id Path param: The unique identifier of the vault
     * @param string $contentType Body param: Content type for PUT operations (optional, defaults to object's content type)
     * @param int $expiresIn Body param: URL expiration time in seconds (1 minute to 7 days)
     * @param Operation|value-of<Operation> $operation Body param: The S3 operation to generate URL for
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
