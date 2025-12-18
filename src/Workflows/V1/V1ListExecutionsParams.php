<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ListExecutionsParams\Status;

/**
 * List all executions for a specific workflow.
 *
 * @see Casedev\Services\Workflows\V1Service::listExecutions()
 *
 * @phpstan-type V1ListExecutionsParamsShape = array{
 *   limit?: int|null, status?: null|Status|value-of<Status>
 * }
 */
final class V1ListExecutionsParams implements BaseModel
{
    /** @use SdkModel<V1ListExecutionsParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
