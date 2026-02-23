<?php

declare(strict_types=1);

namespace Router\Vault\Events\Subscriptions;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Updates callback URL, filters, active state, or signing secret for a vault webhook subscription.
 *
 * @see Router\Services\Vault\Events\SubscriptionsService::update()
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   id: string,
 *   callbackURL?: string|null,
 *   clearSigningSecret?: bool|null,
 *   eventTypes?: list<string>|null,
 *   isActive?: bool|null,
 *   objectIDs?: list<string>|null,
 *   signingSecret?: string|null,
 * }
 */
final class SubscriptionUpdateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Optional('callbackUrl')]
    public ?string $callbackURL;

    #[Optional]
    public ?bool $clearSigningSecret;

    /** @var list<string>|null $eventTypes */
    #[Optional(list: 'string')]
    public ?array $eventTypes;

    #[Optional]
    public ?bool $isActive;

    /** @var list<string>|null $objectIDs */
    #[Optional('objectIds', list: 'string')]
    public ?array $objectIDs;

    #[Optional]
    public ?string $signingSecret;

    /**
     * `new SubscriptionUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdateParams)->withID(...)
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
     * @param list<string>|null $eventTypes
     * @param list<string>|null $objectIDs
     */
    public static function with(
        string $id,
        ?string $callbackURL = null,
        ?bool $clearSigningSecret = null,
        ?array $eventTypes = null,
        ?bool $isActive = null,
        ?array $objectIDs = null,
        ?string $signingSecret = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $clearSigningSecret && $self['clearSigningSecret'] = $clearSigningSecret;
        null !== $eventTypes && $self['eventTypes'] = $eventTypes;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;
        null !== $signingSecret && $self['signingSecret'] = $signingSecret;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    public function withClearSigningSecret(bool $clearSigningSecret): self
    {
        $self = clone $this;
        $self['clearSigningSecret'] = $clearSigningSecret;

        return $self;
    }

    /**
     * @param list<string> $eventTypes
     */
    public function withEventTypes(array $eventTypes): self
    {
        $self = clone $this;
        $self['eventTypes'] = $eventTypes;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * @param list<string> $objectIDs
     */
    public function withObjectIDs(array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }

    public function withSigningSecret(string $signingSecret): self
    {
        $self = clone $this;
        $self['signingSecret'] = $signingSecret;

        return $self;
    }
}
