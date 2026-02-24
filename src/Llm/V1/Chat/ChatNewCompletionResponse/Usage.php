<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\Chat\ChatNewCompletionResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageShape = array{
 *   completionTokens?: int|null,
 *   cost?: float|null,
 *   promptTokens?: int|null,
 *   totalTokens?: int|null,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    #[Optional('completion_tokens')]
    public ?int $completionTokens;

    /**
     * Cost in USD.
     */
    #[Optional]
    public ?float $cost;

    #[Optional('prompt_tokens')]
    public ?int $promptTokens;

    #[Optional('total_tokens')]
    public ?int $totalTokens;

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
        ?int $completionTokens = null,
        ?float $cost = null,
        ?int $promptTokens = null,
        ?int $totalTokens = null,
    ): self {
        $self = new self;

        null !== $completionTokens && $self['completionTokens'] = $completionTokens;
        null !== $cost && $self['cost'] = $cost;
        null !== $promptTokens && $self['promptTokens'] = $promptTokens;
        null !== $totalTokens && $self['totalTokens'] = $totalTokens;

        return $self;
    }

    public function withCompletionTokens(int $completionTokens): self
    {
        $self = clone $this;
        $self['completionTokens'] = $completionTokens;

        return $self;
    }

    /**
     * Cost in USD.
     */
    public function withCost(float $cost): self
    {
        $self = clone $this;
        $self['cost'] = $cost;

        return $self;
    }

    public function withPromptTokens(int $promptTokens): self
    {
        $self = clone $this;
        $self['promptTokens'] = $promptTokens;

        return $self;
    }

    public function withTotalTokens(int $totalTokens): self
    {
        $self = clone $this;
        $self['totalTokens'] = $totalTokens;

        return $self;
    }
}
