<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\V1NewEmbeddingResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageShape = array{
 *   promptTokens?: int|null, totalTokens?: int|null
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

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
        ?int $promptTokens = null,
        ?int $totalTokens = null
    ): self {
        $self = new self;

        null !== $promptTokens && $self['promptTokens'] = $promptTokens;
        null !== $totalTokens && $self['totalTokens'] = $totalTokens;

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
