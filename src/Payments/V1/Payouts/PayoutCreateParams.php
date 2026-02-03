<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Payouts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Payouts\PayoutCreateParams\DestinationType;

/**
 * Create a payout to send money to an external bank account.
 *
 * @see Casedev\Services\Payments\V1\PayoutsService::create()
 *
 * @phpstan-type PayoutCreateParamsShape = array{
 *   amount: int,
 *   destinationType: DestinationType|value-of<DestinationType>,
 *   fromAccountID: string,
 *   currency?: string|null,
 *   memo?: string|null,
 *   metadata?: mixed,
 *   partyID?: string|null,
 * }
 */
final class PayoutCreateParams implements BaseModel
{
    /** @use SdkModel<PayoutCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount in cents.
     */
    #[Required]
    public int $amount;

    /** @var value-of<DestinationType> $destinationType */
    #[Required('destination_type', enum: DestinationType::class)]
    public string $destinationType;

    /**
     * Source account.
     */
    #[Required('from_account_id')]
    public string $fromAccountID;

    #[Optional]
    public ?string $currency;

    #[Optional]
    public ?string $memo;

    #[Optional]
    public mixed $metadata;

    /**
     * Recipient party (optional).
     */
    #[Optional('party_id')]
    public ?string $partyID;

    /**
     * `new PayoutCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PayoutCreateParams::with(amount: ..., destinationType: ..., fromAccountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PayoutCreateParams)
     *   ->withAmount(...)
     *   ->withDestinationType(...)
     *   ->withFromAccountID(...)
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
     * @param DestinationType|value-of<DestinationType> $destinationType
     */
    public static function with(
        int $amount,
        DestinationType|string $destinationType,
        string $fromAccountID,
        ?string $currency = null,
        ?string $memo = null,
        mixed $metadata = null,
        ?string $partyID = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['destinationType'] = $destinationType;
        $self['fromAccountID'] = $fromAccountID;

        null !== $currency && $self['currency'] = $currency;
        null !== $memo && $self['memo'] = $memo;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $partyID && $self['partyID'] = $partyID;

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
     * @param DestinationType|value-of<DestinationType> $destinationType
     */
    public function withDestinationType(
        DestinationType|string $destinationType
    ): self {
        $self = clone $this;
        $self['destinationType'] = $destinationType;

        return $self;
    }

    /**
     * Source account.
     */
    public function withFromAccountID(string $fromAccountID): self
    {
        $self = clone $this;
        $self['fromAccountID'] = $fromAccountID;

        return $self;
    }

    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

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
     * Recipient party (optional).
     */
    public function withPartyID(string $partyID): self
    {
        $self = clone $this;
        $self['partyID'] = $partyID;

        return $self;
    }
}
