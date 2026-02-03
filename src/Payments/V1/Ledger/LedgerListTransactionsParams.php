<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Ledger;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Query ledger transactions with optional filters.
 *
 * @see Casedev\Services\Payments\V1\LedgerService::listTransactions()
 *
 * @phpstan-type LedgerListTransactionsParamsShape = array{
 *   endDate?: \DateTimeInterface|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   referenceID?: string|null,
 *   referenceType?: string|null,
 *   startDate?: \DateTimeInterface|null,
 * }
 */
final class LedgerListTransactionsParams implements BaseModel
{
    /** @use SdkModel<LedgerListTransactionsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?\DateTimeInterface $endDate;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    /**
     * Filter by reference ID.
     */
    #[Optional]
    public ?string $referenceID;

    /**
     * Filter by reference type (transfer, charge, payout, etc.).
     */
    #[Optional]
    public ?string $referenceType;

    #[Optional]
    public ?\DateTimeInterface $startDate;

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
        ?\DateTimeInterface $endDate = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $referenceID = null,
        ?string $referenceType = null,
        ?\DateTimeInterface $startDate = null,
    ): self {
        $self = new self;

        null !== $endDate && $self['endDate'] = $endDate;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $referenceID && $self['referenceID'] = $referenceID;
        null !== $referenceType && $self['referenceType'] = $referenceType;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

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
     * Filter by reference ID.
     */
    public function withReferenceID(string $referenceID): self
    {
        $self = clone $this;
        $self['referenceID'] = $referenceID;

        return $self;
    }

    /**
     * Filter by reference type (transfer, charge, payout, etc.).
     */
    public function withReferenceType(string $referenceType): self
    {
        $self = clone $this;
        $self['referenceType'] = $referenceType;

        return $self;
    }

    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
