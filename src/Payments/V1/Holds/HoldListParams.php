<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Holds;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List holds with optional filters.
 *
 * @see Casedev\Services\Payments\V1\HoldsService::list()
 *
 * @phpstan-type HoldListParamsShape = array{
 *   accountID?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   status?: string|null,
 * }
 */
final class HoldListParams implements BaseModel
{
    /** @use SdkModel<HoldListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $accountID;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?string $status;

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
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;

        return $self;
    }

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

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
