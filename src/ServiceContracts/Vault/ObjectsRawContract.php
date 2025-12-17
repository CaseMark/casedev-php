<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams;
use Casedev\Vault\Objects\ObjectDownloadParams;
use Casedev\Vault\Objects\ObjectGetTextParams;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse;
use Casedev\Vault\Objects\ObjectRetrieveParams;

interface ObjectsRawContract
{
    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param array<string,mixed>|ObjectRetrieveParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $objectID,
        array|ObjectRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the vault
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: The unique identifier of the object
     * @param array<string,mixed>|ObjectCreatePresignedURLParams $params
     *
     * @return BaseResponse<ObjectNewPresignedURLResponse>
     *
     * @throws APIException
     */
    public function createPresignedURL(
        string $objectID,
        array|ObjectCreatePresignedURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param array<string,mixed>|ObjectDownloadParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function download(
        string $objectID,
        array|ObjectDownloadParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID The object ID
     * @param array<string,mixed>|ObjectGetTextParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getText(
        string $objectID,
        array|ObjectGetTextParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
