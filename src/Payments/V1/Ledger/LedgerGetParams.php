<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Ledger;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List ledger entries with optional filters by account, transaction, or date range.
 *
 * @see Casedev\Services\Payments\V1\LedgerService::get()
 *
 * @phpstan-type LedgerGetParamsShape = array{
 *   accountID?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   transactionID?: string|null,
 * }
 */
final class LedgerGetParams implements BaseModel
{
    /** @use SdkModel<LedgerGetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by account.
     */
    #[Optional]
    public ?string $accountID;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    /**
     * Filter by transaction.
     */
    #[Optional]
    public ?string $transactionID;

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
        ?int $limit = null,
        ?int $offset = null,
        ?string $transactionID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $transactionID && $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * Filter by account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter by transaction.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
