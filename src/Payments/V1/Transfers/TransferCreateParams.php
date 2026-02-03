<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Transfers;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Create a transfer between payment accounts.
 *
 * @see Casedev\Services\Payments\V1\TransfersService::create()
 *
 * @phpstan-type TransferCreateParamsShape = array{
 *   amount: int,
 *   fromAccountID: string,
 *   toAccountID: string,
 *   memo?: string|null,
 *   metadata?: mixed,
 * }
 */
final class TransferCreateParams implements BaseModel
{
    /** @use SdkModel<TransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount in cents.
     */
    #[Required]
    public int $amount;

    #[Required('from_account_id')]
    public string $fromAccountID;

    #[Required('to_account_id')]
    public string $toAccountID;

    #[Optional]
    public ?string $memo;

    #[Optional]
    public mixed $metadata;

    /**
     * `new TransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferCreateParams::with(amount: ..., fromAccountID: ..., toAccountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferCreateParams)
     *   ->withAmount(...)
     *   ->withFromAccountID(...)
     *   ->withToAccountID(...)
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
    public static function with(
        int $amount,
        string $fromAccountID,
        string $toAccountID,
        ?string $memo = null,
        mixed $metadata = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['fromAccountID'] = $fromAccountID;
        $self['toAccountID'] = $toAccountID;

        null !== $memo && $self['memo'] = $memo;
        null !== $metadata && $self['metadata'] = $metadata;

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

    public function withFromAccountID(string $fromAccountID): self
    {
        $self = clone $this;
        $self['fromAccountID'] = $fromAccountID;

        return $self;
    }

    public function withToAccountID(string $toAccountID): self
    {
        $self = clone $this;
        $self['toAccountID'] = $toAccountID;

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
}
