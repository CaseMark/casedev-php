<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectGetChunksResponse;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChunkShape = array{
 *   index: int,
 *   pageEnd: int|null,
 *   pageStart: int|null,
 *   text: string,
 *   wordEndIndex: int|null,
 *   wordStartIndex: int|null,
 * }
 */
final class Chunk implements BaseModel
{
    /** @use SdkModel<ChunkShape> */
    use SdkModel;

    /**
     * Chunk index within the document.
     */
    #[Required]
    public int $index;

    /**
     * Last page covered by the chunk, if page mapping is available.
     */
    #[Required('page_end')]
    public ?int $pageEnd;

    /**
     * First page covered by the chunk, if page mapping is available.
     */
    #[Required('page_start')]
    public ?int $pageStart;

    /**
     * Full text for the chunk.
     */
    #[Required]
    public string $text;

    /**
     * Last OCR word index covered by the chunk, if available.
     */
    #[Required('word_end_index')]
    public ?int $wordEndIndex;

    /**
     * First OCR word index covered by the chunk, if available.
     */
    #[Required('word_start_index')]
    public ?int $wordStartIndex;

    /**
     * `new Chunk()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Chunk::with(
     *   index: ...,
     *   pageEnd: ...,
     *   pageStart: ...,
     *   text: ...,
     *   wordEndIndex: ...,
     *   wordStartIndex: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Chunk)
     *   ->withIndex(...)
     *   ->withPageEnd(...)
     *   ->withPageStart(...)
     *   ->withText(...)
     *   ->withWordEndIndex(...)
     *   ->withWordStartIndex(...)
     * ```
     */
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
        int $index,
        ?int $pageEnd,
        ?int $pageStart,
        string $text,
        ?int $wordEndIndex,
        ?int $wordStartIndex,
    ): self {
        $self = new self;

        $self['index'] = $index;
        $self['pageEnd'] = $pageEnd;
        $self['pageStart'] = $pageStart;
        $self['text'] = $text;
        $self['wordEndIndex'] = $wordEndIndex;
        $self['wordStartIndex'] = $wordStartIndex;

        return $self;
    }

    /**
     * Chunk index within the document.
     */
    public function withIndex(int $index): self
    {
        $self = clone $this;
        $self['index'] = $index;

        return $self;
    }

    /**
     * Last page covered by the chunk, if page mapping is available.
     */
    public function withPageEnd(?int $pageEnd): self
    {
        $self = clone $this;
        $self['pageEnd'] = $pageEnd;

        return $self;
    }

    /**
     * First page covered by the chunk, if page mapping is available.
     */
    public function withPageStart(?int $pageStart): self
    {
        $self = clone $this;
        $self['pageStart'] = $pageStart;

        return $self;
    }

    /**
     * Full text for the chunk.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Last OCR word index covered by the chunk, if available.
     */
    public function withWordEndIndex(?int $wordEndIndex): self
    {
        $self = clone $this;
        $self['wordEndIndex'] = $wordEndIndex;

        return $self;
    }

    /**
     * First OCR word index covered by the chunk, if available.
     */
    public function withWordStartIndex(?int $wordStartIndex): self
    {
        $self = clone $this;
        $self['wordStartIndex'] = $wordStartIndex;

        return $self;
    }
}
