<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Workflows\V1\V1ListExecutionsResponse\Execution;

/**
 * @phpstan-type V1ListExecutionsResponseShape = array{
 *   executions?: list<Execution>|null
 * }
 */
final class V1ListExecutionsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<V1ListExecutionsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Execution>|null $executions */
    #[Api(list: Execution::class, optional: true)]
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
     * @param list<Execution> $executions
     */
    public static function with(?array $executions = null): self
    {
        $obj = new self;

        null !== $executions && $obj->executions = $executions;

        return $obj;
    }

    /**
     * @param list<Execution> $executions
     */
    public function withExecutions(array $executions): self
    {
        $obj = clone $this;
        $obj->executions = $executions;

        return $obj;
    }
}
