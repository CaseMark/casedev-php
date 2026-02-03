<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Holds;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition;

/**
 * Create a hold on funds in an account with release conditions.
 *
 * @see Casedev\Services\Payments\V1\HoldsService::create()
 *
 * @phpstan-import-type ReleaseConditionShape from \Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition
 *
 * @phpstan-type HoldCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   currency?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   memo?: string|null,
 *   metadata?: mixed,
 *   onReleaseAction?: string|null,
 *   onReleaseConfig?: mixed,
 *   releaseConditions?: list<ReleaseCondition|ReleaseConditionShape>|null,
 * }
 */
final class HoldCreateParams implements BaseModel
{
    /** @use SdkModel<HoldCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Account to hold funds in.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * Amount in cents to hold.
     */
    #[Required]
    public int $amount;

    #[Optional]
    public ?string $currency;

    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    #[Optional]
    public ?string $memo;

    #[Optional]
    public mixed $metadata;

    /**
     * Action to take when released.
     */
    #[Optional('on_release_action')]
    public ?string $onReleaseAction;

    #[Optional('on_release_config')]
    public mixed $onReleaseConfig;

    /** @var list<ReleaseCondition>|null $releaseConditions */
    #[Optional('release_conditions', list: ReleaseCondition::class)]
    public ?array $releaseConditions;

    /**
     * `new HoldCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HoldCreateParams::with(accountID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HoldCreateParams)->withAccountID(...)->withAmount(...)
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
     * @param list<ReleaseCondition|ReleaseConditionShape>|null $releaseConditions
     */
    public static function with(
        string $accountID,
        int $amount,
        ?string $currency = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $memo = null,
        mixed $metadata = null,
        ?string $onReleaseAction = null,
        mixed $onReleaseConfig = null,
        ?array $releaseConditions = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;

        null !== $currency && $self['currency'] = $currency;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $memo && $self['memo'] = $memo;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $onReleaseAction && $self['onReleaseAction'] = $onReleaseAction;
        null !== $onReleaseConfig && $self['onReleaseConfig'] = $onReleaseConfig;
        null !== $releaseConditions && $self['releaseConditions'] = $releaseConditions;

        return $self;
    }

    /**
     * Account to hold funds in.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Amount in cents to hold.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withMemo(string $memo): self
    {
        $self = clone $this;
        $self['memo'] = $memo;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Action to take when released.
     */
    public function withOnReleaseAction(string $onReleaseAction): self
    {
        $self = clone $this;
        $self['onReleaseAction'] = $onReleaseAction;

        return $self;
    }

    public function withOnReleaseConfig(mixed $onReleaseConfig): self
    {
        $self = clone $this;
        $self['onReleaseConfig'] = $onReleaseConfig;

        return $self;
    }

    /**
     * @param list<ReleaseCondition|ReleaseConditionShape> $releaseConditions
     */
    public function withReleaseConditions(array $releaseConditions): self
    {
        $self = clone $this;
        $self['releaseConditions'] = $releaseConditions;

        return $self;
    }
}
