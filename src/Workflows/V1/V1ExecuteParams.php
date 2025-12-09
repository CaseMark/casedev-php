<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Execute a workflow for testing. This runs the workflow synchronously without deployment.
 *
 * @see Casedev\Services\Workflows\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{body?: mixed}
 */
final class V1ExecuteParams implements BaseModel
{
    /** @use SdkModel<V1ExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Input data to pass to the workflow trigger.
     */
    #[Optional]
    public mixed $body;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(mixed $body = null): self
    {
        $obj = new self;

        null !== $body && $obj['body'] = $body;

        return $obj;
    }

    /**
     * Input data to pass to the workflow trigger.
     */
    public function withBody(mixed $body): self
    {
        $obj = clone $this;
        $obj['body'] = $body;

        return $obj;
    }
}
