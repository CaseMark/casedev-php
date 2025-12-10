<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Functions;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve execution logs from a deployed serverless function. Logs include function output, errors, and runtime information. Useful for debugging and monitoring function performance in production.
 *
 * @see Casedev\Services\Compute\V1\FunctionsService::getLogs()
 *
 * @phpstan-type FunctionGetLogsParamsShape = array{tail?: int}
 */
final class FunctionGetLogsParams implements BaseModel
{
    /** @use SdkModel<FunctionGetLogsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Number of log lines to retrieve (default 200, max 1000).
     */
    #[Optional]
    public ?int $tail;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $tail = null): self
    {
        $self = new self;

        null !== $tail && $self['tail'] = $tail;

        return $self;
    }

    /**
     * Number of log lines to retrieve (default 200, max 1000).
     */
    public function withTail(int $tail): self
    {
        $self = clone $this;
        $self['tail'] = $tail;

        return $self;
    }
}
