<?php

declare(strict_types=1);

namespace CaseDev\Services\Webhooks\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Webhooks\V1\EndpointsRawContract;
use CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams;
use CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes;
use CaseDev\Webhooks\V1\Endpoints\EndpointListParams;
use CaseDev\Webhooks\V1\Endpoints\EndpointRotateSecretParams;
use CaseDev\Webhooks\V1\Endpoints\EndpointTestParams;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams;
use CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\Status;

/**
 * Webhook endpoint management.
 *
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointCreateParams\ResourceScopes
 * @phpstan-import-type ResourceScopesShape from \CaseDev\Webhooks\V1\Endpoints\EndpointUpdateParams\ResourceScopes as ResourceScopesShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class EndpointsRawService implements EndpointsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a webhook endpoint that receives platform events matching the supplied event-type filters. Returns the generated signing secret ONCE — the response is the only time it is shown in plaintext.
     *
     * @param array{
     *   eventTypeFilters: list<string>,
     *   url: string,
     *   description?: string,
     *   resourceScopes?: ResourceScopes|ResourceScopesShape,
     * }|EndpointCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|EndpointCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EndpointCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'webhooks/v1/endpoints',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get webhook endpoint
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/v1/endpoints/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Partially updates a webhook endpoint. Any omitted field is left unchanged. Signing secrets are rotated via the separate /rotate_secret endpoint.
     *
     * @param array{
     *   description?: string|null,
     *   eventTypeFilters?: list<string>,
     *   resourceScopes?: EndpointUpdateParams\ResourceScopes|ResourceScopesShape1|null,
     *   status?: Status|value-of<Status>,
     *   url?: string,
     * }|EndpointUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|EndpointUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EndpointUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['webhooks/v1/endpoints/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns the organization's webhook endpoints, newest first. Signing secrets are never included.
     *
     * @param array{
     *   limit?: int,
     *   status?: EndpointListParams\Status|value-of<EndpointListParams\Status>,
     * }|EndpointListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        array|EndpointListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EndpointListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'webhooks/v1/endpoints',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Soft-deletes a webhook endpoint. Delivery stops immediately and the endpoint no longer appears in list results. Delivery history is preserved (and can be fetched via GET /deliveries with the endpoint_id filter) so audit trails and post-mortem debugging remain possible.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['webhooks/v1/endpoints/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Generates a new signing secret for the endpoint. The previous secret remains valid until `previousSecretExpiresInSec` elapses (default 24h, max 30 days). During the grace window deliveries are signed with both secrets so receivers can migrate without downtime. Returns the new secret — this is the only time it is shown in plaintext.
     *
     * @param array{
     *   previousSecretExpiresInSec?: int
     * }|EndpointRotateSecretParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function rotateSecret(
        string $id,
        array|EndpointRotateSecretParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EndpointRotateSecretParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['webhooks/v1/endpoints/%1$s/rotate_secret', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Synchronously delivers a synthetic `webhook.test` event to the endpoint and returns the HTTP result. No retries. Useful for validating that a new endpoint is reachable and its signature verifier works. The delivery is not persisted in the delivery history.
     *
     * @param array{eventType?: string, payload?: mixed}|EndpointTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function test(
        string $id,
        array|EndpointTestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EndpointTestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['webhooks/v1/endpoints/%1$s/test', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
