<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Log\LogCreateParams;
use CaseDev\Matters\V1\Log\LogExportParams;
use CaseDev\Matters\V1\Log\LogExportResponse;
use CaseDev\Matters\V1\Log\LogListParams;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface LogRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LogCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|LogCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LogExportParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogExportResponse>
     *
     * @throws APIException
     */
    public function export(
        string $id,
        array|LogExportParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
