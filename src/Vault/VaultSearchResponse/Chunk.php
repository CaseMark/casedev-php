<?php

declare(strict_types=1);

namespace Router\Vault\VaultSearchResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChunkShape = array{
 *   chunkIndex?: int|null,
 *   distance?: float|null,
 *   objectID?: string|null,
 *   pageEnd?: int|null,
 *   pageStart?: int|null,
 *   score?: float|null,
 *   source?: string|null,
 *   text?: string|null,
 *   wordEndIndex?: int|null,
 *   wordStartIndex?: int|null,
 * }
 */
final class Chunk implements BaseModel
{
    /** @use SdkModel<ChunkShape> */
    use SdkModel;

    /**
     * Index of the chunk within the document (0-based).
     */
    #[Optional('chunk_index')]
    public ?int $chunkIndex;

    /**
     * Vector similarity distance (lower is more similar).
     */
    #[Optional]
    public ?float $distance;

    /**
     * ID of the source document.
     */
    #[Optional('object_id')]
    public ?string $objectID;

    /**
     * PDF page number where the chunk ends (1-indexed). Null for non-PDF documents or documents ingested before page tracking was added.
     */
    #[Optional('page_end', nullable: true)]
    public ?int $pageEnd;

    /**
     * PDF page number where the chunk begins (1-indexed). Null for non-PDF documents or documents ingested before page tracking was added.
     */
    #[Optional('page_start', nullable: true)]
    public ?int $pageStart;

    /**
     * Relevance score (deprecated, use distance or hybridScore).
     */
    #[Optional]
    public ?float $score;

    /**
     * Source identifier (deprecated, use object_id).
     */
    #[Optional]
    public ?string $source;

    /**
     * Preview of the chunk text (up to 500 characters).
     */
    #[Optional]
    public ?string $text;

    /**
     * Ending word index (0-based) in the OCR word list. Use with GET /vault/:id/objects/:objectId/ocr-words to retrieve bounding boxes for highlighting.
     */
    #[Optional('word_end_index', nullable: true)]
    public ?int $wordEndIndex;

    /**
     * Starting word index (0-based) in the OCR word list. Use with GET /vault/:id/objects/:objectId/ocr-words to retrieve bounding boxes for highlighting.
     */
    #[Optional('word_start_index', nullable: true)]
    public ?int $wordStartIndex;

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
        ?int $chunkIndex = null,
        ?float $distance = null,
        ?string $objectID = null,
        ?int $pageEnd = null,
        ?int $pageStart = null,
        ?float $score = null,
        ?string $source = null,
        ?string $text = null,
        ?int $wordEndIndex = null,
        ?int $wordStartIndex = null,
    ): self {
        $self = new self;

        null !== $chunkIndex && $self['chunkIndex'] = $chunkIndex;
        null !== $distance && $self['distance'] = $distance;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $pageEnd && $self['pageEnd'] = $pageEnd;
        null !== $pageStart && $self['pageStart'] = $pageStart;
        null !== $score && $self['score'] = $score;
        null !== $source && $self['source'] = $source;
        null !== $text && $self['text'] = $text;
        null !== $wordEndIndex && $self['wordEndIndex'] = $wordEndIndex;
        null !== $wordStartIndex && $self['wordStartIndex'] = $wordStartIndex;

        return $self;
    }

    /**
     * Index of the chunk within the document (0-based).
     */
    public function withChunkIndex(int $chunkIndex): self
    {
        $self = clone $this;
        $self['chunkIndex'] = $chunkIndex;

        return $self;
    }

    /**
     * Vector similarity distance (lower is more similar).
     */
    public function withDistance(float $distance): self
    {
        $self = clone $this;
        $self['distance'] = $distance;

        return $self;
    }

    /**
     * ID of the source document.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * PDF page number where the chunk ends (1-indexed). Null for non-PDF documents or documents ingested before page tracking was added.
     */
    public function withPageEnd(?int $pageEnd): self
    {
        $self = clone $this;
        $self['pageEnd'] = $pageEnd;

        return $self;
    }

    /**
     * PDF page number where the chunk begins (1-indexed). Null for non-PDF documents or documents ingested before page tracking was added.
     */
    public function withPageStart(?int $pageStart): self
    {
        $self = clone $this;
        $self['pageStart'] = $pageStart;

        return $self;
    }

    /**
     * Relevance score (deprecated, use distance or hybridScore).
     */
    public function withScore(float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Source identifier (deprecated, use object_id).
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Preview of the chunk text (up to 500 characters).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Ending word index (0-based) in the OCR word list. Use with GET /vault/:id/objects/:objectId/ocr-words to retrieve bounding boxes for highlighting.
     */
    public function withWordEndIndex(?int $wordEndIndex): self
    {
        $self = clone $this;
        $self['wordEndIndex'] = $wordEndIndex;

        return $self;
    }

    /**
     * Starting word index (0-based) in the OCR word list. Use with GET /vault/:id/objects/:objectId/ocr-words to retrieve bounding boxes for highlighting.
     */
    public function withWordStartIndex(?int $wordStartIndex): self
    {
        $self = clone $this;
        $self['wordStartIndex'] = $wordStartIndex;

        return $self;
    }
}
