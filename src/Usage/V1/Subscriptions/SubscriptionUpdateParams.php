<?php

declare(strict_types=1);

namespace CaseDev\Usage\V1\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Updates callback URL, event filters, active state, or signing secret.
 *
 * @see CaseDev\Services\Usage\V1\SubscriptionsService::update()
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   callbackURL?: string|null,
 *   clearSigningSecret?: bool|null,
 *   eventTypes?: list<string>|null,
 *   isActive?: bool|null,
 *   signingSecret?: string|null,
 * }
 */
final class SubscriptionUpdateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('callbackUrl')]
    public ?string $callbackURL;

    #[Optional]
    public ?bool $clearSigningSecret;

    /** @var list<string>|null $eventTypes */
    #[Optional(list: 'string')]
    public ?array $eventTypes;

    #[Optional]
    public ?bool $isActive;

    #[Optional]
    public ?string $signingSecret;

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
     */
    public static function with(
        ?string $callbackURL = null,
        ?bool $clearSigningSecret = null,
        ?array $eventTypes = null,
        ?bool $isActive = null,
        ?string $signingSecret = null,
    ): self {
        $self = new self;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $clearSigningSecret && $self['clearSigningSecret'] = $clearSigningSecret;
        null !== $eventTypes && $self['eventTypes'] = $eventTypes;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $signingSecret && $self['signingSecret'] = $signingSecret;

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

    public function withSigningSecret(string $signingSecret): self
    {
        $self = clone $this;
        $self['signingSecret'] = $signingSecret;

        return $self;
    }
}
