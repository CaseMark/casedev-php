<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Accounts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Get ledger entries for a specific account.
 *
 * @see Casedev\Services\Payments\V1\AccountsService::getLedger()
 *
 * @phpstan-type AccountGetLedgerParamsShape = array{
 *   limit?: int|null, offset?: int|null
 * }
 */
final class AccountGetLedgerParams implements BaseModel
{
    /** @use SdkModel<AccountGetLedgerParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $limit = null, ?int $offset = null): self
    {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;

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
}
