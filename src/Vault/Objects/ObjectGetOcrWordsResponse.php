<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectGetOcrWordsResponse\Page;

/**
 * @phpstan-import-type PageShape from \CaseDev\Vault\Objects\ObjectGetOcrWordsResponse\Page
 *
 * @phpstan-type ObjectGetOcrWordsResponseShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   objectID?: string|null,
 *   pageCount?: int|null,
 *   pages?: list<Page|PageShape>|null,
 *   totalWords?: int|null,
 * }
 */
final class ObjectGetOcrWordsResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetOcrWordsResponseShape> */
    use SdkModel;

    /**
     * When the OCR data was extracted.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * The object ID.
     */
    #[Optional('objectId')]
    public ?string $objectID;

    /**
     * Total number of pages in the document.
     */
    #[Optional]
    public ?int $pageCount;

    /**
     * Per-page word data with bounding boxes.
     *
     * @var list<Page>|null $pages
     */
    #[Optional(list: Page::class)]
    public ?array $pages;

    /**
     * Total number of words extracted from the document.
     */
    #[Optional]
    public ?int $totalWords;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Page|PageShape>|null $pages
     */
    public static function with(
        ?\DateTimeInterface $createdAt = null,
        ?string $objectID = null,
        ?int $pageCount = null,
        ?array $pages = null,
        ?int $totalWords = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $pages && $self['pages'] = $pages;
        null !== $totalWords && $self['totalWords'] = $totalWords;

        return $self;
    }

    /**
     * When the OCR data was extracted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The object ID.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Total number of pages in the document.
     */
    public function withPageCount(int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    /**
     * Per-page word data with bounding boxes.
     *
     * @param list<Page|PageShape> $pages
     */
    public function withPages(array $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }

    /**
     * Total number of words extracted from the document.
     */
    public function withTotalWords(int $totalWords): self
    {
        $self = clone $this;
        $self['totalWords'] = $totalWords;

        return $self;
    }
}
