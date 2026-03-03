<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DocketResponse\Entry\Document;

/**
 * @phpstan-import-type DocumentShape from \CaseDev\Legal\V1\V1DocketResponse\Entry\Document
 *
 * @phpstan-type EntryShape = array{
 *   date?: string|null,
 *   description?: string|null,
 *   documents?: list<Document|DocumentShape>|null,
 *   entryNumber?: int|null,
 * }
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $date;

    #[Optional(nullable: true)]
    public ?string $description;

    /** @var list<Document>|null $documents */
    #[Optional(list: Document::class)]
    public ?array $documents;

    #[Optional(nullable: true)]
    public ?int $entryNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Document|DocumentShape>|null $documents
     */
    public static function with(
        ?string $date = null,
        ?string $description = null,
        ?array $documents = null,
        ?int $entryNumber = null,
    ): self {
        $self = new self;

        null !== $date && $self['date'] = $date;
        null !== $description && $self['description'] = $description;
        null !== $documents && $self['documents'] = $documents;
        null !== $entryNumber && $self['entryNumber'] = $entryNumber;

        return $self;
    }

    public function withDate(?string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<Document|DocumentShape> $documents
     */
    public function withDocuments(array $documents): self
    {
        $self = clone $this;
        $self['documents'] = $documents;

        return $self;
    }

    public function withEntryNumber(?int $entryNumber): self
    {
        $self = clone $this;
        $self['entryNumber'] = $entryNumber;

        return $self;
    }
}
