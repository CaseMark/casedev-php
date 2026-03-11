<?php

declare(strict_types=1);

namespace CaseDev\Vault\Events\Subscriptions;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a webhook subscription for vault lifecycle events. Optional object filters can limit notifications to specific vault objects.
 *
 * @see CaseDev\Services\Vault\Events\SubscriptionsService::create()
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

    /**
     * Webhook endpoint URL that will receive vault event deliveries.
     */
    #[Required('callbackUrl')]
    public string $callbackURL;

    /**
     * Vault event types to deliver. Omit to receive the default supported set.
     *
     * @var list<string>|null $eventTypes
     */
    #[Optional(list: 'string')]
    public ?array $eventTypes;

    /**
     * Vault object IDs to limit notifications to. Omit to receive events for all objects in the vault.
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('objectIds', list: 'string')]
    public ?array $objectIDs;

    /**
     * Optional secret used to sign outbound webhook deliveries.
     */
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

    /**
     * Webhook endpoint URL that will receive vault event deliveries.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * Vault event types to deliver. Omit to receive the default supported set.
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
     * Vault object IDs to limit notifications to. Omit to receive events for all objects in the vault.
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
     * Optional secret used to sign outbound webhook deliveries.
     */
    public function withSigningSecret(string $signingSecret): self
    {
        $self = clone $this;
        $self['signingSecret'] = $signingSecret;

        return $self;
    }
}
