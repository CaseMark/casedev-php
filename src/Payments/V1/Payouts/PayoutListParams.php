<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Payouts;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Payouts\PayoutListParams\Status;

/**
 * List payouts with optional filters.
 *
 * @see Casedev\Services\Payments\V1\PayoutsService::list()
 *
 * @phpstan-type PayoutListParamsShape = array{
 *   fromAccountID?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   partyID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class PayoutListParams implements BaseModel
{
    /** @use SdkModel<PayoutListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $fromAccountID;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?string $partyID;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $fromAccountID = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $partyID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $fromAccountID && $self['fromAccountID'] = $fromAccountID;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $partyID && $self['partyID'] = $partyID;
        null !== $status && $self['status'] = $status;

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

    public function withPartyID(string $partyID): self
    {
        $self = clone $this;
        $self['partyID'] = $partyID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
