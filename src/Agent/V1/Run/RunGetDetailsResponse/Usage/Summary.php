<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SummaryShape = array{
 *   costMicros?: int|null,
 *   totalInputTokens?: int|null,
 *   totalOutputTokens?: int|null,
 *   totalTokens?: int|null,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    #[Optional]
    public ?int $costMicros;

    #[Optional]
    public ?int $totalInputTokens;

    #[Optional]
    public ?int $totalOutputTokens;

    #[Optional]
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
        ?int $costMicros = null,
        ?int $totalInputTokens = null,
        ?int $totalOutputTokens = null,
        ?int $totalTokens = null,
    ): self {
        $self = new self;

        null !== $costMicros && $self['costMicros'] = $costMicros;
        null !== $totalInputTokens && $self['totalInputTokens'] = $totalInputTokens;
        null !== $totalOutputTokens && $self['totalOutputTokens'] = $totalOutputTokens;
        null !== $totalTokens && $self['totalTokens'] = $totalTokens;

        return $self;
    }

    public function withCostMicros(int $costMicros): self
    {
        $self = clone $this;
        $self['costMicros'] = $costMicros;

        return $self;
    }

    public function withTotalInputTokens(int $totalInputTokens): self
    {
        $self = clone $this;
        $self['totalInputTokens'] = $totalInputTokens;

        return $self;
    }

    public function withTotalOutputTokens(int $totalOutputTokens): self
    {
        $self = clone $this;
        $self['totalOutputTokens'] = $totalOutputTokens;

        return $self;
    }

    public function withTotalTokens(int $totalTokens): self
    {
        $self = clone $this;
        $self['totalTokens'] = $totalTokens;

        return $self;
    }
}
