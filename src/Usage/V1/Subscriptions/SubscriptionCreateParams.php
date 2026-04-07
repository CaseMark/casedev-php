<?php

declare(strict_types=1);

namespace CaseDev\Usage\V1\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a webhook subscription for usage, balance, and billing events.
 *
 * @see CaseDev\Services\Usage\V1\SubscriptionsService::create()
 *
 * @phpstan-type SubscriptionCreateParamsShape = array{
 *   callbackURL: string,
 *   eventTypes?: list<string>|null,
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
     */
    public static function with(
        string $callbackURL,
        ?array $eventTypes = null,
        ?string $signingSecret = null
    ): self {
        $self = new self;

        $self['callbackURL'] = $callbackURL;

        null !== $eventTypes && $self['eventTypes'] = $eventTypes;
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

    public function withSigningSecret(string $signingSecret): self
    {
        $self = clone $this;
        $self['signingSecret'] = $signingSecret;

        return $self;
    }
}
