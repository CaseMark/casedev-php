<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Charges;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * List charges with optional filters.
 *
 * @see Casedev\Services\Payments\V1\ChargesService::list()
 *
 * @phpstan-type ChargeListParamsShape = array{
 *   destinationAccountID?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   partyID?: string|null,
 *   status?: string|null,
 * }
 */
final class ChargeListParams implements BaseModel
{
    /** @use SdkModel<ChargeListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $destinationAccountID;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?string $partyID;

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
        ?string $destinationAccountID = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $partyID = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $destinationAccountID && $self['destinationAccountID'] = $destinationAccountID;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $partyID && $self['partyID'] = $partyID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

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

    public function withPartyID(string $partyID): self
    {
        $self = clone $this;
        $self['partyID'] = $partyID;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
