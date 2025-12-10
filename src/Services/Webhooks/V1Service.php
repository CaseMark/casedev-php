<?php

declare(strict_types=1);

namespace Casedev\Services\Webhooks;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Webhooks\V1Contract;
use Casedev\Webhooks\V1\V1NewResponse;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

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
    ): V1NewResponse {
        $params = [
            'events' => $events, 'url' => $url, 'description' => $description,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific webhook endpoint, including its URL, description, subscribed events, and status.
     *
     * @param string $id Unique identifier of the webhook endpoint
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a webhook endpoint from your organization. This action is irreversible and will stop all webhook deliveries to the specified URL.
     *
     * @param string $id Unique identifier of the webhook endpoint to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
