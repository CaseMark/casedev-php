<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Deliveries;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Webhooks\V1\Deliveries\DeliveryListParams\Status;

/**
 * Returns delivery attempts for the organization, newest first. Filter by endpoint_id or status to narrow results.
 *
 * @see CaseDev\Services\Webhooks\V1\DeliveriesService::list()
 *
 * @phpstan-type DeliveryListParamsShape = array{
 *   endpointID?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class DeliveryListParams implements BaseModel
{
    /** @use SdkModel<DeliveryListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $endpointID;

    #[Optional]
    public ?int $limit;

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
        ?string $endpointID = null,
        ?int $limit = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $endpointID && $self['endpointID'] = $endpointID;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withEndpointID(string $endpointID): self
    {
        $self = clone $this;
        $self['endpointID'] = $endpointID;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

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
