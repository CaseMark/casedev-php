<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Multipart\MultipartAbortParams;
use CaseDev\Vault\Multipart\MultipartGetPartURLsParams;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
}
