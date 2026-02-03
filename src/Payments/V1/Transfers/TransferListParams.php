<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Transfers;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List transfers with optional filters.
 *
 * @see Casedev\Services\Payments\V1\TransfersService::list()
 *
 * @phpstan-type TransferListParamsShape = array{
 *   fromAccountID?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   status?: string|null,
 *   toAccountID?: string|null,
 * }
 */
final class TransferListParams implements BaseModel
{
    /** @use SdkModel<TransferListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $fromAccountID;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?string $toAccountID;

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
        ?string $fromAccountID = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $status = null,
        ?string $toAccountID = null,
    ): self {
        $self = new self;

        null !== $fromAccountID && $self['fromAccountID'] = $fromAccountID;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;
        null !== $toAccountID && $self['toAccountID'] = $toAccountID;

        return $self;
    }

    public function withFromAccountID(string $fromAccountID): self
    {
        $self = clone $this;
        $self['fromAccountID'] = $fromAccountID;

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

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withToAccountID(string $toAccountID): self
    {
        $self = clone $this;
        $self['toAccountID'] = $toAccountID;

        return $self;
    }
}
