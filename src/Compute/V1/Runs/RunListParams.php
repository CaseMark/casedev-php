<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Runs;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve a list of recent compute runs for your organization. Filter by environment or function, and limit the number of results returned. Useful for monitoring serverless function executions and tracking performance metrics.
 *
 * @see Casedev\Services\Compute\V1\RunsService::list()
 *
 * @phpstan-type RunListParamsShape = array{
 *   env?: string, function?: string, limit?: int
 * }
 */
final class RunListParams implements BaseModel
{
    /** @use SdkModel<RunListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name to filter runs by.
     */
    #[Optional]
    public ?string $env;

    /**
     * Function name to filter runs by.
     */
    #[Optional]
    public ?string $function;

    /**
     * Maximum number of runs to return (1-100, default: 50).
     */
    #[Optional]
    public ?int $limit;

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
        ?string $env = null,
        ?string $function = null,
        ?int $limit = null
    ): self {
        $obj = new self;

        null !== $env && $obj['env'] = $env;
        null !== $function && $obj['function'] = $function;
        null !== $limit && $obj['limit'] = $limit;

        return $obj;
    }

    /**
     * Environment name to filter runs by.
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj['env'] = $env;

        return $obj;
    }

    /**
     * Function name to filter runs by.
     */
    public function withFunction(string $function): self
    {
        $obj = clone $this;
        $obj['function'] = $function;

        return $obj;
    }

    /**
     * Maximum number of runs to return (1-100, default: 50).
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj['limit'] = $limit;

        return $obj;
    }
}
