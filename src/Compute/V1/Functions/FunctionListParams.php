<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Functions;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieves all serverless functions deployed in a specified compute environment. Functions can be used for custom document processing, AI model inference, or other computational tasks in legal workflows.
 *
 * @see Casedev\Services\Compute\V1\FunctionsService::list()
 *
 * @phpstan-type FunctionListParamsShape = array{env?: string}
 */
final class FunctionListParams implements BaseModel
{
    /** @use SdkModel<FunctionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name. If not specified, uses the default environment.
     */
    #[Optional]
    public ?string $env;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $env = null): self
    {
        $self = new self;

        null !== $env && $self['env'] = $env;

        return $self;
    }

    /**
     * Environment name. If not specified, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }
}
