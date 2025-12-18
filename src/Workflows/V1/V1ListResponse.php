<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ListResponse\Workflow;

/**
 * @phpstan-import-type WorkflowShape from \Casedev\Workflows\V1\V1ListResponse\Workflow
 *
 * @phpstan-type V1ListResponseShape = array{
 *   limit?: int|null,
 *   offset?: int|null,
 *   total?: int|null,
 *   workflows?: list<WorkflowShape>|null,
 * }
 */
final class V1ListResponse implements BaseModel
{
    /** @use SdkModel<V1ListResponseShape> */
    use SdkModel;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?int $total;

    /** @var list<Workflow>|null $workflows */
    #[Optional(list: Workflow::class)]
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
     * @param list<WorkflowShape>|null $workflows
     */
    public static function with(
        ?int $limit = null,
        ?int $offset = null,
        ?int $total = null,
        ?array $workflows = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $total && $self['total'] = $total;
        null !== $workflows && $self['workflows'] = $workflows;

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

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param list<WorkflowShape> $workflows
     */
    public function withWorkflows(array $workflows): self
    {
        $self = clone $this;
        $self['workflows'] = $workflows;

        return $self;
    }
}
