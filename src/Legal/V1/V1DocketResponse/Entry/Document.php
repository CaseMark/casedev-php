<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketResponse\Entry;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentShape = array{
 *   id?: string|null,
 *   attachmentNumber?: int|null,
 *   description?: string|null,
 *   documentNumber?: string|null,
 *   isAvailable?: bool|null,
 *   pageCount?: int|null,
 *   pdfURL?: string|null,
 * }
 */
final class Document implements BaseModel
{
    /** @use SdkModel<DocumentShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional(nullable: true)]
    public ?int $attachmentNumber;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $documentNumber;

    #[Optional]
    public ?bool $isAvailable;

    #[Optional(nullable: true)]
    public ?int $pageCount;

    #[Optional('pdfUrl', nullable: true)]
    public ?string $pdfURL;

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
        ?string $id = null,
        ?int $attachmentNumber = null,
        ?string $description = null,
        ?string $documentNumber = null,
        ?bool $isAvailable = null,
        ?int $pageCount = null,
        ?string $pdfURL = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $attachmentNumber && $self['attachmentNumber'] = $attachmentNumber;
        null !== $description && $self['description'] = $description;
        null !== $documentNumber && $self['documentNumber'] = $documentNumber;
        null !== $isAvailable && $self['isAvailable'] = $isAvailable;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $pdfURL && $self['pdfURL'] = $pdfURL;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAttachmentNumber(?int $attachmentNumber): self
    {
        $self = clone $this;
        $self['attachmentNumber'] = $attachmentNumber;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDocumentNumber(?string $documentNumber): self
    {
        $self = clone $this;
        $self['documentNumber'] = $documentNumber;

        return $self;
    }

    public function withIsAvailable(bool $isAvailable): self
    {
        $self = clone $this;
        $self['isAvailable'] = $isAvailable;

        return $self;
    }

    public function withPageCount(?int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    public function withPdfURL(?string $pdfURL): self
    {
        $self = clone $this;
        $self['pdfURL'] = $pdfURL;

        return $self;
    }
}
