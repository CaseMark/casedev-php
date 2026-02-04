<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Vault;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Vault\Multipart\MultipartAbortParams;
use Casedev\Vault\Multipart\MultipartCompleteParams;
use Casedev\Vault\Multipart\MultipartGetPartURLsParams;
use Casedev\Vault\Multipart\MultipartGetPartURLsResponse;
use Casedev\Vault\Multipart\MultipartInitParams;
use Casedev\Vault\Multipart\MultipartInitResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface MultipartRawContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param array<string,mixed>|MultipartAbortParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function abort(
        string $id,
        array|MultipartAbortParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param array<string,mixed>|MultipartCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function complete(
        string $id,
        array|MultipartCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param array<string,mixed>|MultipartGetPartURLsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MultipartGetPartURLsResponse>
     *
     * @throws APIException
     */
    public function getPartURLs(
        string $id,
        array|MultipartGetPartURLsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Vault ID to upload the file to
     * @param array<string,mixed>|MultipartInitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MultipartInitResponse>
     *
     * @throws APIException
     */
    public function init(
        string $id,
        array|MultipartInitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
