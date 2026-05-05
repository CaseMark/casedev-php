<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectGetPagesResponse\Metadata;
use CaseDev\Vault\Objects\ObjectGetPagesResponse\Page;

/**
 * @phpstan-import-type MetadataShape from \CaseDev\Vault\Objects\ObjectGetPagesResponse\Metadata
 * @phpstan-import-type PageShape from \CaseDev\Vault\Objects\ObjectGetPagesResponse\Page
 *
 * @phpstan-type ObjectGetPagesResponseShape = array{
 *   metadata: Metadata|MetadataShape, pages: list<Page|PageShape>
 * }
 */
final class ObjectGetPagesResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetPagesResponseShape> */
    use SdkModel;

    #[Required]
    public Metadata $metadata;

    /**
     * Per-page OCR text in ascending page order.
     *
     * @var list<Page> $pages
     */
    #[Required(list: Page::class)]
    public array $pages;

    /**
     * `new ObjectGetPagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetPagesResponse::with(metadata: ..., pages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetPagesResponse)->withMetadata(...)->withPages(...)
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
     * @param Metadata|MetadataShape $metadata
     * @param list<Page|PageShape> $pages
     */
    public static function with(Metadata|array $metadata, array $pages): self
    {
        $self = new self;

        $self['metadata'] = $metadata;
        $self['pages'] = $pages;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Per-page OCR text in ascending page order.
     *
     * @param list<Page|PageShape> $pages
     */
    public function withPages(array $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }
}
