<?php

declare(strict_types=1);

namespace Casedev\Templates\V1\V1ExecuteResponse;

use Casedev\Core\Attributes\Optional;
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

    #[Optional]
    public ?int $completion_tokens;

    /**
     * Total cost in USD.
     */
    #[Optional]
    public ?float $cost;

    #[Optional]
    public ?int $prompt_tokens;

    #[Optional]
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

        null !== $completion_tokens && $obj['completion_tokens'] = $completion_tokens;
        null !== $cost && $obj['cost'] = $cost;
        null !== $prompt_tokens && $obj['prompt_tokens'] = $prompt_tokens;
        null !== $total_tokens && $obj['total_tokens'] = $total_tokens;

        return $obj;
    }

    public function withCompletionTokens(int $completionTokens): self
    {
        $obj = clone $this;
        $obj['completion_tokens'] = $completionTokens;

        return $obj;
    }

    /**
     * Total cost in USD.
     */
    public function withCost(float $cost): self
    {
        $obj = clone $this;
        $obj['cost'] = $cost;

        return $obj;
    }

    public function withPromptTokens(int $promptTokens): self
    {
        $obj = clone $this;
        $obj['prompt_tokens'] = $promptTokens;

        return $obj;
    }

    public function withTotalTokens(int $totalTokens): self
    {
        $obj = clone $this;
        $obj['total_tokens'] = $totalTokens;

        return $obj;
    }
}
