<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\EndpointsContract;
use CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\Status;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes as ResourceScopesShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class EndpointsService implements EndpointsContract
{
    /**
     * @api
     */
    public EndpointsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EndpointsRawService($client);
    }

    /**
     * @api
     *
     * Creates a webhook endpoint that receives platform events matching the supplied event-type filters. Returns the generated signing secret ONCE — the response is the only time it is shown in plaintext.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'eventTypeFilters' => $eventTypeFilters,
                'url' => $url,
                'description' => $description,
                'resourceScopes' => $resourceScopes,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get webhook endpoint
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Partially updates a webhook endpoint. Any omitted field is left unchanged. Signing secrets are rotated via the separate /rotate_secret endpoint.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'eventTypeFilters' => $eventTypeFilters,
                'resourceScopes' => $resourceScopes,
                'status' => $status,
                'url' => $url,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the organization's webhook endpoints, newest first. Signing secrets are never included.
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
    ): mixed {
        $params = Util::removeNulls(['limit' => $limit, 'status' => $status]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Soft-deletes a webhook endpoint. Delivery stops immediately and the endpoint no longer appears in list results. Delivery history is preserved (and can be fetched via GET /deliveries with the endpoint_id filter) so audit trails and post-mortem debugging remain possible.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generates a new signing secret for the endpoint. The previous secret remains valid until `previousSecretExpiresInSec` elapses (default 24h, max 30 days). During the grace window deliveries are signed with both secrets so receivers can migrate without downtime. Returns the new secret — this is the only time it is shown in plaintext.
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
    ): mixed {
        $params = Util::removeNulls(
            ['previousSecretExpiresInSec' => $previousSecretExpiresInSec]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotateSecret($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Synchronously delivers a synthetic `webhook.test` event to the endpoint and returns the HTTP result. No retries. Useful for validating that a new endpoint is reachable and its signature verifier works. The delivery is not persisted in the delivery history.
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
    ): mixed {
        $params = Util::removeNulls(
            ['eventType' => $eventType, 'payload' => $payload]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
