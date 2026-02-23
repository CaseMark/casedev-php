<?php

declare(strict_types=1);

namespace Router\ServiceContracts\Agent\V1;

use Router\Agent\V1\Run\RunCancelResponse;
use Router\Agent\V1\Run\RunExecResponse;
use Router\Agent\V1\Run\RunGetDetailsResponse;
use Router\Agent\V1\Run\RunGetStatusResponse;
use Router\Agent\V1\Run\RunNewResponse;
use Router\Agent\V1\Run\RunWatchResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
interface RunContract
{
    /**
     * @api
     *
     * @param string $agentID ID of the agent to run
     * @param string $prompt Task prompt for the agent
     * @param string|null $guidance Additional guidance for this run
     * @param string|null $model Override the agent default model for this run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $agentID,
        string $prompt,
        ?string $guidance = null,
        ?string $model = null,
        RequestOptions|array|null $requestOptions = null,
    ): RunNewResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunCancelResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function exec(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunExecResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetDetailsResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetStatusResponse;

    /**
     * @api
     *
     * @param string $id Run ID
     * @param string $callbackURL HTTPS URL to receive completion callback
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function watch(
        string $id,
        string $callbackURL,
        RequestOptions|array|null $requestOptions = null,
    ): RunWatchResponse;
}
