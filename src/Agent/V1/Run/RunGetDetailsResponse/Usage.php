<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Token usage statistics.
 *
 * @phpstan-type UsageShape = array{
 *   durationMs?: int|null,
 *   inputTokens?: int|null,
 *   model?: string|null,
 *   outputTokens?: int|null,
 *   toolCalls?: int|null,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    #[Optional]
    public ?int $durationMs;

    #[Optional]
    public ?int $inputTokens;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?int $outputTokens;

    #[Optional]
    public ?int $toolCalls;

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
        ?int $durationMs = null,
        ?int $inputTokens = null,
        ?string $model = null,
        ?int $outputTokens = null,
        ?int $toolCalls = null,
    ): self {
        $self = new self;

        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $inputTokens && $self['inputTokens'] = $inputTokens;
        null !== $model && $self['model'] = $model;
        null !== $outputTokens && $self['outputTokens'] = $outputTokens;
        null !== $toolCalls && $self['toolCalls'] = $toolCalls;

        return $self;
    }

    public function withDurationMs(int $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    public function withInputTokens(int $inputTokens): self
    {
        $self = clone $this;
        $self['inputTokens'] = $inputTokens;

        return $self;
    }

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withOutputTokens(int $outputTokens): self
    {
        $self = clone $this;
        $self['outputTokens'] = $outputTokens;

        return $self;
    }

    public function withToolCalls(int $toolCalls): self
    {
        $self = clone $this;
        $self['toolCalls'] = $toolCalls;

        return $self;
    }
}
