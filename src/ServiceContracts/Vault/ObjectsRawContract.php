<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Vault;

use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\Vault\Objects\ObjectCreatePresignedURLParams;
use Router\Vault\Objects\ObjectDeleteParams;
use Router\Vault\Objects\ObjectDeleteResponse;
use Router\Vault\Objects\ObjectDownloadParams;
use Router\Vault\Objects\ObjectGetOcrWordsParams;
use Router\Vault\Objects\ObjectGetOcrWordsResponse;
use Router\Vault\Objects\ObjectGetResponse;
use Router\Vault\Objects\ObjectGetSummarizeJobParams;
use Router\Vault\Objects\ObjectGetSummarizeJobResponse;
use Router\Vault\Objects\ObjectGetTextParams;
use Router\Vault\Objects\ObjectGetTextResponse;
use Router\Vault\Objects\ObjectListResponse;
use Router\Vault\Objects\ObjectNewPresignedURLResponse;
use Router\Vault\Objects\ObjectRetrieveParams;
use Router\Vault\Objects\ObjectUpdateParams;
use Router\Vault\Objects\ObjectUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface ObjectsRawContract
{
    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param array<string,mixed>|ObjectRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: Object ID to update
     * @param array<string,mixed>|ObjectUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: Object ID to delete
     * @param array<string,mixed>|ObjectDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: The unique identifier of the object
     * @param array<string,mixed>|ObjectCreatePresignedURLParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Object ID within the vault
     * @param array<string,mixed>|ObjectDownloadParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID Path param: The object ID
     * @param array<string,mixed>|ObjectGetOcrWordsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID CaseMark job ID
     * @param array<string,mixed>|ObjectGetSummarizeJobParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $objectID The object ID
     * @param array<string,mixed>|ObjectGetTextParams $params
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
    ): BaseResponse;
}
