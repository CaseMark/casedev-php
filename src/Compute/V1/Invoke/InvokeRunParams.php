<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke;

use Casedev\Compute\V1\Invoke\InvokeRunParams\FunctionSuffix;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
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
    #[Required(map: 'mixed')]
    public array $input;

    /**
     * If true, returns immediately with run ID for background execution.
     */
    #[Optional]
    public ?bool $async;

    /**
     * Override the auto-detected function suffix.
     *
     * @var value-of<FunctionSuffix>|null $functionSuffix
     */
    #[Optional(enum: FunctionSuffix::class)]
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
        $self = new self;

        $self['input'] = $input;

        null !== $async && $self['async'] = $async;
        null !== $functionSuffix && $self['functionSuffix'] = $functionSuffix;

        return $self;
    }

    /**
     * Input data to pass to the function.
     *
     * @param array<string,mixed> $input
     */
    public function withInput(array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * If true, returns immediately with run ID for background execution.
     */
    public function withAsync(bool $async): self
    {
        $self = clone $this;
        $self['async'] = $async;

        return $self;
    }

    /**
     * Override the auto-detected function suffix.
     *
     * @param FunctionSuffix|value-of<FunctionSuffix> $functionSuffix
     */
    public function withFunctionSuffix(
        FunctionSuffix|string $functionSuffix
    ): self {
        $self = clone $this;
        $self['functionSuffix'] = $functionSuffix;

        return $self;
    }
}
