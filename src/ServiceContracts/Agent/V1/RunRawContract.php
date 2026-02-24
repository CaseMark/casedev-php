<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1;

use CaseDev\Agent\V1\Run\RunCancelResponse;
use CaseDev\Agent\V1\Run\RunCreateParams;
use CaseDev\Agent\V1\Run\RunExecResponse;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse;
use CaseDev\Agent\V1\Run\RunGetStatusResponse;
use CaseDev\Agent\V1\Run\RunNewResponse;
use CaseDev\Agent\V1\Run\RunWatchParams;
use CaseDev\Agent\V1\Run\RunWatchResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface RunRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RunCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RunCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunExecResponse>
     *
     * @throws APIException
     */
    public function exec(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunGetDetailsResponse>
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunGetStatusResponse>
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param array<string,mixed>|RunWatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RunWatchResponse>
     *
     * @throws APIException
     */
    public function watch(
        string $id,
        array|RunWatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
