<?php

declare(strict_types=1);

namespace Router\Vault\Objects;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieves word-level OCR bounding box data for a processed PDF document. Each word includes its text, normalized bounding box coordinates (0-1 range), confidence score, and global word index. Use this data to highlight specific text ranges in a PDF viewer based on word indices from search results.
 *
 * @see Router\Services\Vault\ObjectsService::getOcrWords()
 *
 * @phpstan-type ObjectGetOcrWordsParamsShape = array{
 *   id: string, page?: int|null, wordEnd?: int|null, wordStart?: int|null
 * }
 */
final class ObjectGetOcrWordsParams implements BaseModel
{
    /** @use SdkModel<ObjectGetOcrWordsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Filter to a specific page number (1-indexed). If omitted, returns all pages.
     */
    #[Optional]
    public ?int $page;

    /**
     * Filter to words ending at this index (inclusive). Useful for retrieving words for a specific chunk.
     */
    #[Optional]
    public ?int $wordEnd;

    /**
     * Filter to words starting at this index (inclusive). Useful for retrieving words for a specific chunk.
     */
    #[Optional]
    public ?int $wordStart;

    /**
     * `new ObjectGetOcrWordsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetOcrWordsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetOcrWordsParams)->withID(...)
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
        string $id,
        ?int $page = null,
        ?int $wordEnd = null,
        ?int $wordStart = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $page && $self['page'] = $page;
        null !== $wordEnd && $self['wordEnd'] = $wordEnd;
        null !== $wordStart && $self['wordStart'] = $wordStart;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Filter to a specific page number (1-indexed). If omitted, returns all pages.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Filter to words ending at this index (inclusive). Useful for retrieving words for a specific chunk.
     */
    public function withWordEnd(int $wordEnd): self
    {
        $self = clone $this;
        $self['wordEnd'] = $wordEnd;

        return $self;
    }

    /**
     * Filter to words starting at this index (inclusive). Useful for retrieving words for a specific chunk.
     */
    public function withWordStart(int $wordStart): self
    {
        $self = clone $this;
        $self['wordStart'] = $wordStart;

        return $self;
    }
}
