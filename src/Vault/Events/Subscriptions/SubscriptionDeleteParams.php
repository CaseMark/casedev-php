<?php

declare(strict_types=1);

namespace Casedev\Vault\Events\Subscriptions;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Deactivates a vault webhook subscription.
 *
 * @see Casedev\Services\Vault\Events\SubscriptionsService::delete()
 *
 * @phpstan-type SubscriptionDeleteParamsShape = array{id: string}
 */
final class SubscriptionDeleteParams implements BaseModel
{
    /** @use SdkModel<SubscriptionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new SubscriptionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionDeleteParams)->withID(...)
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
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
