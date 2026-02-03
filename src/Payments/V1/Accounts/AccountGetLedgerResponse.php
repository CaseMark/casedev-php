<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AccountGetLedgerResponseShape = array{
 *   entries?: list<mixed>|null, pagination?: mixed
 * }
 */
final class AccountGetLedgerResponse implements BaseModel
{
    /** @use SdkModel<AccountGetLedgerResponseShape> */
    use SdkModel;

    /** @var list<mixed>|null $entries */
    #[Optional(list: 'mixed')]
    public ?array $entries;

    #[Optional]
    public mixed $pagination;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed>|null $entries
     */
    public static function with(
        ?array $entries = null,
        mixed $pagination = null
    ): self {
        $self = new self;

        null !== $entries && $self['entries'] = $entries;
        null !== $pagination && $self['pagination'] = $pagination;

        return $self;
    }

    /**
     * @param list<mixed> $entries
     */
    public function withEntries(array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }

    public function withPagination(mixed $pagination): self
    {
        $self = clone $this;
        $self['pagination'] = $pagination;

        return $self;
    }
}
