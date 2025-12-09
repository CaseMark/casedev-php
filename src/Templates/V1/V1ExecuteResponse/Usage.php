<?php

declare(strict_types=1);

namespace Casedev\Templates\V1\V1ExecuteResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

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
     * Total cost in USD.
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
        $obj = new self;

        null !== $completionTokens && $obj['completionTokens'] = $completionTokens;
        null !== $cost && $obj['cost'] = $cost;
        null !== $promptTokens && $obj['promptTokens'] = $promptTokens;
        null !== $totalTokens && $obj['totalTokens'] = $totalTokens;

        return $obj;
    }

    public function withCompletionTokens(int $completionTokens): self
    {
        $obj = clone $this;
        $obj['completionTokens'] = $completionTokens;

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
        $obj['promptTokens'] = $promptTokens;

        return $obj;
    }

    public function withTotalTokens(int $totalTokens): self
    {
        $obj = clone $this;
        $obj['totalTokens'] = $totalTokens;

        return $obj;
    }
}
