<?php

declare(strict_types=1);

namespace CaseDev\Vault\Events\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Delivers a test event to a single vault webhook subscription. Uses the same payload shape, signature, and retry behavior as production event delivery.
 *
 * @see CaseDev\Services\Vault\Events\SubscriptionsService::test()
 *
 * @phpstan-type SubscriptionTestParamsShape = array{
 *   id: string,
 *   eventType?: string|null,
 *   objectID?: string|null,
 *   payload?: array<string,mixed>|null,
 * }
 */
final class SubscriptionTestParams implements BaseModel
{
    /** @use SdkModel<SubscriptionTestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Optional event type override for this test.
     */
    #[Optional]
    public ?string $eventType;

    /**
     * Optional object ID for object-scoped payload testing.
     */
    #[Optional('objectId')]
    public ?string $objectID;

    /**
     * Optional additional fields merged into payload.data.
     *
     * @var array<string,mixed>|null $payload
     */
    #[Optional(map: 'mixed')]
    public ?array $payload;

    /**
     * `new SubscriptionTestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionTestParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionTestParams)->withID(...)
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
     * @param array<string,mixed>|null $payload
     */
    public static function with(
        string $id,
        ?string $eventType = null,
        ?string $objectID = null,
        ?array $payload = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $eventType && $self['eventType'] = $eventType;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $payload && $self['payload'] = $payload;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Optional event type override for this test.
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Optional object ID for object-scoped payload testing.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Optional additional fields merged into payload.data.
     *
     * @param array<string,mixed> $payload
     */
    public function withPayload(array $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }
}
