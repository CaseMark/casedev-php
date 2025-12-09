<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ListResponse\Workflow;

/**
 * @phpstan-type V1ListResponseShape = array{
 *   limit?: int|null,
 *   offset?: int|null,
 *   total?: int|null,
 *   workflows?: list<Workflow>|null,
 * }
 */
final class V1ListResponse implements BaseModel
{
    /** @use SdkModel<V1ListResponseShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?int $limit;

    #[Api(optional: true)]
    public ?int $offset;

    #[Api(optional: true)]
    public ?int $total;

    /** @var list<Workflow>|null $workflows */
    #[Api(list: Workflow::class, optional: true)]
    public ?array $workflows;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Workflow|array{
     *   id?: string|null,
     *   createdAt?: string|null,
     *   deployedAt?: string|null,
     *   description?: string|null,
     *   name?: string|null,
     *   triggerType?: string|null,
     *   updatedAt?: string|null,
     *   visibility?: string|null,
     * }> $workflows
     */
    public static function with(
        ?int $limit = null,
        ?int $offset = null,
        ?int $total = null,
        ?array $workflows = null,
    ): self {
        $obj = new self;

        null !== $limit && $obj['limit'] = $limit;
        null !== $offset && $obj['offset'] = $offset;
        null !== $total && $obj['total'] = $total;
        null !== $workflows && $obj['workflows'] = $workflows;

        return $obj;
    }

    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj['limit'] = $limit;

        return $obj;
    }

    public function withOffset(int $offset): self
    {
        $obj = clone $this;
        $obj['offset'] = $offset;

        return $obj;
    }

    public function withTotal(int $total): self
    {
        $obj = clone $this;
        $obj['total'] = $total;

        return $obj;
    }

    /**
     * @param list<Workflow|array{
     *   id?: string|null,
     *   createdAt?: string|null,
     *   deployedAt?: string|null,
     *   description?: string|null,
     *   name?: string|null,
     *   triggerType?: string|null,
     *   updatedAt?: string|null,
     *   visibility?: string|null,
     * }> $workflows
     */
    public function withWorkflows(array $workflows): self
    {
        $obj = clone $this;
        $obj['workflows'] = $workflows;

        return $obj;
    }
}
