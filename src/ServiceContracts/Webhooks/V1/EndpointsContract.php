<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Webhooks\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\Status;

/**
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes as ResourceScopesShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface EndpointsContract
{
    /**
     * @api
     *
     * @param list<string> $eventTypeFilters Glob patterns of event types to deliver (e.g. "vault.*", "ocr.job.completed", "*")
     * @param string $url HTTPS callback URL that will receive event deliveries
     * @param string $description Human-readable label for this endpoint
     * @param ResourceScopes|ResourceScopesShape $resourceScopes Optional per-resource allowlists. If vaultIds is set, only events for those vaults are delivered. Same for matterIds.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $eventTypeFilters,
        string $url,
        ?string $description = null,
        ResourceScopes|array|null $resourceScopes = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

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
     * @param list<string> $eventTypeFilters
     * @param \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes|ResourceScopesShape1|null $resourceScopes
     * @param Status|value-of<Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?array $eventTypeFilters = null,
        \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes|array|null $resourceScopes = null,
        Status|string|null $status = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param \CaseDev\Webhooks\V1\Endpoints\EndpointListParams\Status|value-of<\CaseDev\Webhooks\V1\Endpoints\EndpointListParams\Status> $status Filter by endpoint status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 50,
        \CaseDev\Webhooks\V1\Endpoints\EndpointListParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param int $previousSecretExpiresInSec How long (seconds) the old secret continues to be accepted. 0 invalidates immediately. Default: 86400 (24h).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateSecret(
        string $id,
        ?int $previousSecretExpiresInSec = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $eventType Event type to simulate. Defaults to "webhook.test".
     * @param mixed $payload Custom `data` payload. Defaults to a small placeholder.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $id,
        ?string $eventType = null,
        mixed $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
