<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Deliveries;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Re-sends the original event to its endpoint. The payload is reconstructed from the delivery record (same eventId, eventType, and occurred_at). The signature header includes `svix-delivery-attempt: replay` so receivers can distinguish replays from first-time deliveries. Uses the endpoint's current signing secret — not the one in force at the original delivery time.
 *
 * @see CaseDev\Services\Webhooks\V1\DeliveriesService::replay()
 *
 * @phpstan-type DeliveryReplayParamsShape = array{payload?: mixed}
 */
final class DeliveryReplayParams implements BaseModel
{
    /** @use SdkModel<DeliveryReplayParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Override payload to deliver. Must only be supplied when the delivery record lacks enough context to reconstruct the original event (rare). Defaults to an empty data envelope.
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
    public static function with(mixed $payload = null): self
    {
        $self = new self;

        null !== $payload && $self['payload'] = $payload;

        return $self;
    }

    /**
     * Override payload to deliver. Must only be supplied when the delivery record lacks enough context to reconstruct the original event (rare). Defaults to an empty data envelope.
     */
    public function withPayload(mixed $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }
}
