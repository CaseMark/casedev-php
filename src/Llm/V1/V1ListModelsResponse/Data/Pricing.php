<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\V1ListModelsResponse\Data;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PricingShape = array{
 *   input?: string|null, inputCacheRead?: string|null, output?: string|null
 * }
 */
final class Pricing implements BaseModel
{
    /** @use SdkModel<PricingShape> */
    use SdkModel;

    /**
     * Input token price per token.
     */
    #[Optional]
    public ?string $input;

    /**
     * Cache read price per token (if supported).
     */
    #[Optional('input_cache_read')]
    public ?string $inputCacheRead;

    /**
     * Output token price per token.
     */
    #[Optional]
    public ?string $output;

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
        ?string $input = null,
        ?string $inputCacheRead = null,
        ?string $output = null
    ): self {
        $self = new self;

        null !== $input && $self['input'] = $input;
        null !== $inputCacheRead && $self['inputCacheRead'] = $inputCacheRead;
        null !== $output && $self['output'] = $output;

        return $self;
    }

    /**
     * Input token price per token.
     */
    public function withInput(string $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Cache read price per token (if supported).
     */
    public function withInputCacheRead(string $inputCacheRead): self
    {
        $self = clone $this;
        $self['inputCacheRead'] = $inputCacheRead;

        return $self;
    }

    /**
     * Output token price per token.
     */
    public function withOutput(string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }
}
