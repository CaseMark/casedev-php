<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectGetPagesResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectGetPagesResponse\Metadata\Source;

/**
 * @phpstan-type MetadataShape = array{
 *   filename: string,
 *   objectID: string,
 *   pageCount: int,
 *   returnedPages: int,
 *   source: Source|value-of<Source>,
 *   vaultID: string,
 *   end?: int|null,
 *   start?: int|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    #[Required]
    public string $filename;

    #[Required('object_id')]
    public string $objectID;

    /**
     * Total number of pages with extracted text in the document.
     */
    #[Required('page_count')]
    public int $pageCount;

    /**
     * Number of pages returned after applying the range filter.
     */
    #[Required('returned_pages')]
    public int $returnedPages;

    /**
     * Where the page text came from. `ocr` for PDFs (per-page OCR sidecar). `txt` for plain-text files split on form-feed (\f) characters.
     *
     * @var value-of<Source> $source
     */
    #[Required(enum: Source::class)]
    public string $source;

    #[Required('vault_id')]
    public string $vaultID;

    /**
     * Echoes the end query param if provided.
     */
    #[Optional(nullable: true)]
    public ?int $end;

    /**
     * Echoes the start query param if provided.
     */
    #[Optional(nullable: true)]
    public ?int $start;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   filename: ...,
     *   objectID: ...,
     *   pageCount: ...,
     *   returnedPages: ...,
     *   source: ...,
     *   vaultID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metadata)
     *   ->withFilename(...)
     *   ->withObjectID(...)
     *   ->withPageCount(...)
     *   ->withReturnedPages(...)
     *   ->withSource(...)
     *   ->withVaultID(...)
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
     *
     * @param Source|value-of<Source> $source
     */
    public static function with(
        string $filename,
        string $objectID,
        int $pageCount,
        int $returnedPages,
        Source|string $source,
        string $vaultID,
        ?int $end = null,
        ?int $start = null,
    ): self {
        $self = new self;

        $self['filename'] = $filename;
        $self['objectID'] = $objectID;
        $self['pageCount'] = $pageCount;
        $self['returnedPages'] = $returnedPages;
        $self['source'] = $source;
        $self['vaultID'] = $vaultID;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Total number of pages with extracted text in the document.
     */
    public function withPageCount(int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    /**
     * Number of pages returned after applying the range filter.
     */
    public function withReturnedPages(int $returnedPages): self
    {
        $self = clone $this;
        $self['returnedPages'] = $returnedPages;

        return $self;
    }

    /**
     * Where the page text came from. `ocr` for PDFs (per-page OCR sidecar). `txt` for plain-text files split on form-feed (\f) characters.
     *
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Echoes the end query param if provided.
     */
    public function withEnd(?int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Echoes the start query param if provided.
     */
    public function withStart(?int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
