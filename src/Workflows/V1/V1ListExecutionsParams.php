<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
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
 *   limit?: int, status?: Status|value-of<Status>
 * }
 */
final class V1ListExecutionsParams implements BaseModel
{
    /** @use SdkModel<V1ListExecutionsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
    public ?int $limit;

    /** @var value-of<Status>|null $status */
    #[Api(enum: Status::class, optional: true)]
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?int $limit = null,
        Status|string|null $status = null
    ): self {
        $obj = new self;

        null !== $limit && $obj['limit'] = $limit;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj['limit'] = $limit;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
