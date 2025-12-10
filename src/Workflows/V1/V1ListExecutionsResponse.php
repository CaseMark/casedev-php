<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ListExecutionsResponse\Execution;

/**
 * @phpstan-type V1ListExecutionsResponseShape = array{
 *   executions?: list<Execution>|null
 * }
 */
final class V1ListExecutionsResponse implements BaseModel
{
    /** @use SdkModel<V1ListExecutionsResponseShape> */
    use SdkModel;

    /** @var list<Execution>|null $executions */
    #[Optional(list: Execution::class)]
    public ?array $executions;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Execution|array{
     *   id?: string|null,
     *   completedAt?: string|null,
     *   durationMs?: int|null,
     *   startedAt?: string|null,
     *   status?: string|null,
     *   triggerType?: string|null,
     * }> $executions
     */
    public static function with(?array $executions = null): self
    {
        $self = new self;

        null !== $executions && $self['executions'] = $executions;

        return $self;
    }

    /**
     * @param list<Execution|array{
     *   id?: string|null,
     *   completedAt?: string|null,
     *   durationMs?: int|null,
     *   startedAt?: string|null,
     *   status?: string|null,
     *   triggerType?: string|null,
     * }> $executions
     */
    public function withExecutions(array $executions): self
    {
        $self = clone $this;
        $self['executions'] = $executions;

        return $self;
    }
}
