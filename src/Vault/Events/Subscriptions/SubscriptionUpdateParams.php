<?php

declare(strict_types=1);

namespace CaseDev\Vault\Events\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Updates callback URL, filters, active state, or signing secret for a vault webhook subscription.
 *
 * @see CaseDev\Services\Vault\Events\SubscriptionsService::update()
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

    /**
     * Updated webhook endpoint URL for deliveries.
     */
    #[Optional('callbackUrl')]
    public ?string $callbackURL;

    /**
     * Whether to remove the existing signing secret.
     */
    #[Optional]
    public ?bool $clearSigningSecret;

    /**
     * Updated event types to deliver for this subscription.
     *
     * @var list<string>|null $eventTypes
     */
    #[Optional(list: 'string')]
    public ?array $eventTypes;

    /**
     * Whether the subscription should continue delivering events.
     */
    #[Optional]
    public ?bool $isActive;

    /**
     * Updated vault object IDs to limit notifications to. Pass an empty array to remove the filter.
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('objectIds', list: 'string')]
    public ?array $objectIDs;

    /**
     * Replacement secret used to sign webhook deliveries.
     */
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

    /**
     * Updated webhook endpoint URL for deliveries.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * Whether to remove the existing signing secret.
     */
    public function withClearSigningSecret(bool $clearSigningSecret): self
    {
        $self = clone $this;
        $self['clearSigningSecret'] = $clearSigningSecret;

        return $self;
    }

    /**
     * Updated event types to deliver for this subscription.
     *
     * @param list<string> $eventTypes
     */
    public function withEventTypes(array $eventTypes): self
    {
        $self = clone $this;
        $self['eventTypes'] = $eventTypes;

        return $self;
    }

    /**
     * Whether the subscription should continue delivering events.
     */
    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * Updated vault object IDs to limit notifications to. Pass an empty array to remove the filter.
     *
     * @param list<string> $objectIDs
     */
    public function withObjectIDs(array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }

    /**
     * Replacement secret used to sign webhook deliveries.
     */
    public function withSigningSecret(string $signingSecret): self
    {
        $self = clone $this;
        $self['signingSecret'] = $signingSecret;

        return $self;
    }
}
