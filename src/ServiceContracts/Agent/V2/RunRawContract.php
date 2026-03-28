<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2;

use CaseDev\Agent\V2\Run\RunCreateParams;
use CaseDev\Agent\V2\Run\RunEventsParams;
use CaseDev\Agent\V2\Run\RunExecResponse;
use CaseDev\Agent\V2\Run\RunGetStatusResponse;
use CaseDev\Agent\V2\Run\RunNewResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Contracts\BaseStream;
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
     * @param array<string,mixed>|RunEventsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function eventsStream(
        string $id,
        array|RunEventsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
}
