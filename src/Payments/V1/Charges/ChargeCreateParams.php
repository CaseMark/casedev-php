<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Charges;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Create a charge (payment request) to collect money from a party.
 *
 * @see Casedev\Services\Payments\V1\ChargesService::create()
 *
 * @phpstan-type ChargeCreateParamsShape = array{
 *   amount: int,
 *   destinationAccountID: string,
 *   partyID: string,
 *   currency?: string|null,
 *   description?: string|null,
 *   metadata?: mixed,
 *   paymentMethods?: list<string>|null,
 * }
 */
final class ChargeCreateParams implements BaseModel
{
    /** @use SdkModel<ChargeCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount in cents.
     */
    #[Required]
    public int $amount;

    /**
     * Account to receive funds.
     */
    #[Required('destination_account_id')]
    public string $destinationAccountID;

    /**
     * Party to charge.
     */
    #[Required('party_id')]
    public string $partyID;

    #[Optional]
    public ?string $currency;

    #[Optional]
    public ?string $description;

    #[Optional]
    public mixed $metadata;

    /** @var list<string>|null $paymentMethods */
    #[Optional('payment_methods', list: 'string')]
    public ?array $paymentMethods;

    /**
     * `new ChargeCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChargeCreateParams::with(amount: ..., destinationAccountID: ..., partyID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChargeCreateParams)
     *   ->withAmount(...)
     *   ->withDestinationAccountID(...)
     *   ->withPartyID(...)
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
     * @param list<string>|null $paymentMethods
     */
    public static function with(
        int $amount,
        string $destinationAccountID,
        string $partyID,
        ?string $currency = null,
        ?string $description = null,
        mixed $metadata = null,
        ?array $paymentMethods = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['destinationAccountID'] = $destinationAccountID;
        $self['partyID'] = $partyID;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $paymentMethods && $self['paymentMethods'] = $paymentMethods;

        return $self;
    }

    /**
     * Amount in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Account to receive funds.
     */
    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

        return $self;
    }

    /**
     * Party to charge.
     */
    public function withPartyID(string $partyID): self
    {
        $self = clone $this;
        $self['partyID'] = $partyID;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param list<string> $paymentMethods
     */
    public function withPaymentMethods(array $paymentMethods): self
    {
        $self = clone $this;
        $self['paymentMethods'] = $paymentMethods;

        return $self;
    }
}
