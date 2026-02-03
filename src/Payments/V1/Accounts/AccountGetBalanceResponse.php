<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AccountGetBalanceResponseShape = array{
 *   accountID?: string|null,
 *   availableBalance?: float|null,
 *   balance?: float|null,
 *   currency?: string|null,
 *   heldAmount?: float|null,
 *   pendingCharges?: float|null,
 * }
 */
final class AccountGetBalanceResponse implements BaseModel
{
    /** @use SdkModel<AccountGetBalanceResponseShape> */
    use SdkModel;

    #[Optional('accountId')]
    public ?string $accountID;

    /**
     * Balance minus holds.
     */
    #[Optional]
    public ?float $availableBalance;

    /**
     * Total balance in cents.
     */
    #[Optional]
    public ?float $balance;

    #[Optional]
    public ?string $currency;

    /**
     * Amount held by active holds.
     */
    #[Optional]
    public ?float $heldAmount;

    /**
     * Pending incoming payments.
     */
    #[Optional]
    public ?float $pendingCharges;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $accountID = null,
        ?float $availableBalance = null,
        ?float $balance = null,
        ?string $currency = null,
        ?float $heldAmount = null,
        ?float $pendingCharges = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $availableBalance && $self['availableBalance'] = $availableBalance;
        null !== $balance && $self['balance'] = $balance;
        null !== $currency && $self['currency'] = $currency;
        null !== $heldAmount && $self['heldAmount'] = $heldAmount;
        null !== $pendingCharges && $self['pendingCharges'] = $pendingCharges;

        return $self;
    }

    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Balance minus holds.
     */
    public function withAvailableBalance(float $availableBalance): self
    {
        $self = clone $this;
        $self['availableBalance'] = $availableBalance;

        return $self;
    }

    /**
     * Total balance in cents.
     */
    public function withBalance(float $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Amount held by active holds.
     */
    public function withHeldAmount(float $heldAmount): self
    {
        $self = clone $this;
        $self['heldAmount'] = $heldAmount;

        return $self;
    }

    /**
     * Pending incoming payments.
     */
    public function withPendingCharges(float $pendingCharges): self
    {
        $self = clone $this;
        $self['pendingCharges'] = $pendingCharges;

        return $self;
    }
}
