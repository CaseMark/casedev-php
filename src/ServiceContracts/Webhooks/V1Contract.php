<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Webhooks;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Webhooks\V1\V1NewResponse;

interface V1Contract
{
    /**
     * @api
     *
     * @param list<string> $events Array of event types to subscribe to
     * @param string $url HTTPS URL where webhook events will be sent
     * @param string $description Optional description for the webhook
     *
     * @throws APIException
     */
    public function create(
        array $events,
        string $url,
        ?string $description = null,
        ?RequestOptions $requestOptions = null,
    ): V1NewResponse;

    /**
     * @api
     *
     * @param string $id Unique identifier of the webhook endpoint
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed;

    /**
     * @api
     *
     * @param string $id Unique identifier of the webhook endpoint to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
