<?php

declare(strict_types=1);

namespace CaseDev\Webhooks\V1\Endpoints;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Webhooks\V1\Endpoints\EndpointListParams\Status;

/**
 * Returns the organization's webhook endpoints, newest first. Signing secrets are never included.
 *
 * @see CaseDev\Services\Webhooks\V1\EndpointsService::list()
 *
 * @phpstan-type EndpointListParamsShape = array{
 *   limit?: int|null, status?: null|Status|value-of<Status>
 * }
 */
final class EndpointListParams implements BaseModel
{
    /** @use SdkModel<EndpointListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?int $limit;

    /**
     * Filter by endpoint status.
     *
     * @var value-of<Status>|null $status
     */
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
        ?int $limit = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by endpoint status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
