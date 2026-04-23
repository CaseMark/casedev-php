<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Webhooks\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams\Status;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface DeliveriesContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param Status|value-of<Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $endpointID = null,
        int $limit = 50,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $payload Override payload to deliver. Must only be supplied when the delivery record lacks enough context to reconstruct the original event (rare). Defaults to an empty data envelope.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        mixed $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
