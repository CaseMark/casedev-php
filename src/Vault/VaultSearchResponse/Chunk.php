<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultSearchResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChunkShape = array{
 *   score?: float|null, source?: string|null, text?: string|null
 * }
 */
final class Chunk implements BaseModel
{
    /** @use SdkModel<ChunkShape> */
    use SdkModel;

    #[Optional]
    public ?float $score;

    #[Optional]
    public ?string $source;

    #[Optional]
    public ?string $text;

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
        ?float $score = null,
        ?string $source = null,
        ?string $text = null
    ): self {
        $self = new self;

        null !== $score && $self['score'] = $score;
        null !== $source && $self['source'] = $source;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    public function withScore(float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
