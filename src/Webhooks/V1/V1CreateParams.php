<?php

declare(strict_types=1);

namespace Casedev\Webhooks\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
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
 * @see Casedev\Services\Webhooks\V1Service::create()
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   events: list<string>, url: string, description?: string
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of event types to subscribe to.
     *
     * @var list<string> $events
     */
    #[Api(list: 'string')]
    public array $events;

    /**
     * HTTPS URL where webhook events will be sent.
     */
    #[Api]
    public string $url;

    /**
     * Optional description for the webhook.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(events: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withEvents(...)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $events
     */
    public static function with(
        array $events,
        string $url,
        ?string $description = null
    ): self {
        $obj = new self;

        $obj['events'] = $events;
        $obj['url'] = $url;

        null !== $description && $obj['description'] = $description;

        return $obj;
    }

    /**
     * Array of event types to subscribe to.
     *
     * @param list<string> $events
     */
    public function withEvents(array $events): self
    {
        $obj = clone $this;
        $obj['events'] = $events;

        return $obj;
    }

    /**
     * HTTPS URL where webhook events will be sent.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * Optional description for the webhook.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }
}
