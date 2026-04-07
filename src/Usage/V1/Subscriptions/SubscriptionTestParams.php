<?php

declare(strict_types=1);

namespace CaseDev\Usage\V1\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Delivers a test event to a single usage webhook subscription using the same payload shape and signing behavior as production delivery.
 *
 * @see CaseDev\Services\Usage\V1\SubscriptionsService::test()
 *
 * @phpstan-type SubscriptionTestParamsShape = array{
 *   eventType?: string|null, payload?: array<string,mixed>|null
 * }
 */
final class SubscriptionTestParams implements BaseModel
{
    /** @use SdkModel<SubscriptionTestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $eventType;

    /** @var array<string,mixed>|null $payload */
    #[Optional(map: 'mixed')]
    public ?array $payload;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $payload
     */
    public static function with(
        ?string $eventType = null,
        ?array $payload = null
    ): self {
        $self = new self;

        null !== $eventType && $self['eventType'] = $eventType;
        null !== $payload && $self['payload'] = $payload;

        return $self;
    }

    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * @param array<string,mixed> $payload
     */
    public function withPayload(array $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }
}
