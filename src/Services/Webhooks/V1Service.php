<?php

declare(strict_types=1);

namespace Casedev\Services\Webhooks;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Webhooks\V1Contract;
use Casedev\Webhooks\V1\V1CreateParams;
use Casedev\Webhooks\V1\V1NewResponse;

final class V1Service implements V1Contract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new webhook endpoint to receive real-time notifications for events in your Case.dev workspace. Webhooks enable automated workflows by sending HTTP POST requests to your specified URL when events occur.
     *
     * **Security**: Webhooks are signed with HMAC-SHA256 using the provided secret. The signature is included in the `X-Case-Signature` header.
     *
     * **Available Events**:
     * - `document.processed` - Document OCR/processing completed
     * - `vault.updated` - Document added/removed from vault
     * - `action.completed` - Workflow action finished
     * - `compute.finished` - Compute job completed
     *
     * @param array{
     *   events: list<string>, url: string, description?: string
     * }|V1CreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        ?RequestOptions $requestOptions = null
    ): V1NewResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'webhooks/v1',
            body: (object) $parsed,
            options: $options,
            convert: V1NewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific webhook endpoint, including its URL, description, subscribed events, and status.
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve all webhook endpoints configured for your organization. Webhooks allow you to receive real-time notifications when events occur in your Case.dev workspace, such as document processing completion, OCR results, or workflow status changes.
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): mixed
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'webhooks/v1',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delete a webhook endpoint from your organization. This action is irreversible and will stop all webhook deliveries to the specified URL.
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['webhooks/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
