<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Synchronously delivers a synthetic `webhook.test` event to the endpoint and returns the HTTP result. No retries. Useful for validating that a new endpoint is reachable and its signature verifier works. The delivery is not persisted in the delivery history.
 *
 * @see CaseDev\Services\Webhooks\V1\EndpointsService::test()
 *
 * @phpstan-type EndpointTestParamsShape = array{
 *   eventType?: string|null, payload?: mixed
 * }
 */
final class EndpointTestParams implements BaseModel
{
    /** @use SdkModel<EndpointTestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Event type to simulate. Defaults to "webhook.test".
     */
    #[Optional]
    public ?string $eventType;

    /**
     * Custom `data` payload. Defaults to a small placeholder.
     */
    #[Optional]
    public mixed $payload;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $eventType = null,
        mixed $payload = null
    ): self {
        $self = new self;

        null !== $eventType && $self['eventType'] = $eventType;
        null !== $payload && $self['payload'] = $payload;

        return $self;
    }

    /**
     * Event type to simulate. Defaults to "webhook.test".
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Custom `data` payload. Defaults to a small placeholder.
     */
    public function withPayload(mixed $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }
}
