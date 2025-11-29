<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat\ChatNewCompletionResponse;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageShape = array{
 *   completion_tokens?: int|null,
 *   cost?: float|null,
 *   prompt_tokens?: int|null,
 *   total_tokens?: int|null,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?int $completion_tokens;

    /**
     * Cost in USD.
     */
    #[Api(optional: true)]
    public ?float $cost;

    #[Api(optional: true)]
    public ?int $prompt_tokens;

    #[Api(optional: true)]
    public ?int $total_tokens;

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
        ?int $completion_tokens = null,
        ?float $cost = null,
        ?int $prompt_tokens = null,
        ?int $total_tokens = null,
    ): self {
        $obj = new self;

        null !== $completion_tokens && $obj->completion_tokens = $completion_tokens;
        null !== $cost && $obj->cost = $cost;
        null !== $prompt_tokens && $obj->prompt_tokens = $prompt_tokens;
        null !== $total_tokens && $obj->total_tokens = $total_tokens;

        return $obj;
    }

    public function withCompletionTokens(int $completionTokens): self
    {
        $obj = clone $this;
        $obj->completion_tokens = $completionTokens;

        return $obj;
    }

    /**
     * Cost in USD.
     */
    public function withCost(float $cost): self
    {
        $obj = clone $this;
        $obj->cost = $cost;

        return $obj;
    }

    public function withPromptTokens(int $promptTokens): self
    {
        $obj = clone $this;
        $obj->prompt_tokens = $promptTokens;

        return $obj;
    }

    public function withTotalTokens(int $totalTokens): self
    {
        $obj = clone $this;
        $obj->total_tokens = $totalTokens;

        return $obj;
    }
}
