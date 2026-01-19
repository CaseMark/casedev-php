<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultGetResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Document chunking strategy configuration.
 *
 * @phpstan-type ChunkStrategyShape = array{
 *   chunkSize?: int|null,
 *   method?: string|null,
 *   minChunkSize?: int|null,
 *   overlap?: int|null,
 * }
 */
final class ChunkStrategy implements BaseModel
{
    /** @use SdkModel<ChunkStrategyShape> */
    use SdkModel;

    /**
     * Target size for each chunk in tokens.
     */
    #[Optional]
    public ?int $chunkSize;

    /**
     * Chunking method (e.g., 'semantic', 'fixed').
     */
    #[Optional]
    public ?string $method;

    /**
     * Minimum chunk size in tokens.
     */
    #[Optional]
    public ?int $minChunkSize;

    /**
     * Number of overlapping tokens between chunks.
     */
    #[Optional]
    public ?int $overlap;

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
        ?int $chunkSize = null,
        ?string $method = null,
        ?int $minChunkSize = null,
        ?int $overlap = null,
    ): self {
        $self = new self;

        null !== $chunkSize && $self['chunkSize'] = $chunkSize;
        null !== $method && $self['method'] = $method;
        null !== $minChunkSize && $self['minChunkSize'] = $minChunkSize;
        null !== $overlap && $self['overlap'] = $overlap;

        return $self;
    }

    /**
     * Target size for each chunk in tokens.
     */
    public function withChunkSize(int $chunkSize): self
    {
        $self = clone $this;
        $self['chunkSize'] = $chunkSize;

        return $self;
    }

    /**
     * Chunking method (e.g., 'semantic', 'fixed').
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * Minimum chunk size in tokens.
     */
    public function withMinChunkSize(int $minChunkSize): self
    {
        $self = clone $this;
        $self['minChunkSize'] = $minChunkSize;

        return $self;
    }

    /**
     * Number of overlapping tokens between chunks.
     */
    public function withOverlap(int $overlap): self
    {
        $self = clone $this;
        $self['overlap'] = $overlap;

        return $self;
    }
}
