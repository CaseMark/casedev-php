<?php

declare(strict_types=1);

namespace Router\Vault\Events\Subscriptions;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Creates a webhook subscription for vault lifecycle events. Optional object filters can limit notifications to specific vault objects.
 *
 * @see Router\Services\Vault\Events\SubscriptionsService::create()
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   callbackURL: string,
 *   eventTypes?: list<string>|null,
 *   objectIDs?: list<string>|null,
 *   signingSecret?: string|null,
 * }
 */
final class SubscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('callbackUrl')]
    public string $callbackURL;

    /** @var list<string>|null $eventTypes */
    #[Optional(list: 'string')]
    public ?array $eventTypes;

    /** @var list<string>|null $objectIDs */
    #[Optional('objectIds', list: 'string')]
    public ?array $objectIDs;

    #[Optional]
    public ?string $signingSecret;

    /**
     * `new SubscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionCreateParams::with(callbackURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionCreateParams)->withCallbackURL(...)
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
        string $callbackURL,
        ?array $eventTypes = null,
        ?array $objectIDs = null,
        ?string $signingSecret = null,
    ): self {
        $self = new self;

        $self['callbackURL'] = $callbackURL;

        null !== $eventTypes && $self['eventTypes'] = $eventTypes;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;
        null !== $signingSecret && $self['signingSecret'] = $signingSecret;

        return $self;
    }

    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

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
