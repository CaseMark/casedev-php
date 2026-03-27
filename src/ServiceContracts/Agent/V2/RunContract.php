<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2;

use CaseDev\Agent\V2\Run\RunExecResponse;
use CaseDev\Agent\V2\Run\RunGetStatusResponse;
use CaseDev\Agent\V2\Run\RunNewResponse;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface RunContract
{
    /**
     * @api
     *
     * @param list<string>|null $objectIDs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $agentID,
        string $prompt,
        ?string $callbackURL = null,
        ?string $guidance = null,
        ?string $model = null,
        ?array $objectIDs = null,
        RequestOptions|array|null $requestOptions = null,
    ): RunNewResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function eventsStream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDetails(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RunGetStatusResponse;
}
