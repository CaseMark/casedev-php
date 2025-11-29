<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke;

use Casedev\Compute\V1\Invoke\InvokeRunParams\FunctionSuffix;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Execute a deployed compute function with custom input data. Supports both synchronous and asynchronous execution modes. Functions can be invoked by ID or name and can process various types of input data for legal document analysis, data processing, or other computational tasks.
 *
 * @see Casedev\Services\Compute\V1\InvokeService::run()
 *
 * @phpstan-type InvokeRunParamsShape = array{
 *   input: array<string,mixed>,
 *   async?: bool,
 *   functionSuffix?: FunctionSuffix|value-of<FunctionSuffix>,
 * }
 */
final class InvokeRunParams implements BaseModel
{
    /** @use SdkModel<InvokeRunParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Input data to pass to the function.
     *
     * @var array<string,mixed> $input
     */
    #[Api(map: 'mixed')]
    public array $input;

    /**
     * If true, returns immediately with run ID for background execution.
     */
    #[Api(optional: true)]
    public ?bool $async;

    /**
     * Override the auto-detected function suffix.
     *
     * @var value-of<FunctionSuffix>|null $functionSuffix
     */
    #[Api(enum: FunctionSuffix::class, optional: true)]
    public ?string $functionSuffix;

    /**
     * `new InvokeRunParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvokeRunParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvokeRunParams)->withInput(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed> $input
     * @param FunctionSuffix|value-of<FunctionSuffix> $functionSuffix
     */
    public static function with(
        array $input,
        ?bool $async = null,
        FunctionSuffix|string|null $functionSuffix = null,
    ): self {
        $obj = new self;

        $obj->input = $input;

        null !== $async && $obj->async = $async;
        null !== $functionSuffix && $obj['functionSuffix'] = $functionSuffix;

        return $obj;
    }

    /**
     * Input data to pass to the function.
     *
     * @param array<string,mixed> $input
     */
    public function withInput(array $input): self
    {
        $obj = clone $this;
        $obj->input = $input;

        return $obj;
    }

    /**
     * If true, returns immediately with run ID for background execution.
     */
    public function withAsync(bool $async): self
    {
        $obj = clone $this;
        $obj->async = $async;

        return $obj;
    }

    /**
     * Override the auto-detected function suffix.
     *
     * @param FunctionSuffix|value-of<FunctionSuffix> $functionSuffix
     */
    public function withFunctionSuffix(
        FunctionSuffix|string $functionSuffix
    ): self {
        $obj = clone $this;
        $obj['functionSuffix'] = $functionSuffix;

        return $obj;
    }
}
