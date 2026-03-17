<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1SecFilingResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1SecFilingResponse\Filing\Document;
use CaseDev\Legal\V1\V1SecFilingResponse\Filing\Entity;

/**
 * @phpstan-import-type DocumentShape from \CaseDev\Legal\V1\V1SecFilingResponse\Filing\Document
 * @phpstan-import-type EntityShape from \CaseDev\Legal\V1\V1SecFilingResponse\Filing\Entity
 *
 * @phpstan-type FilingShape = array{
 *   accessionNumber?: string|null,
 *   description?: string|null,
 *   documents?: list<Document|DocumentShape>|null,
 *   entity?: null|Entity|EntityShape,
 *   filedAt?: string|null,
 *   formType?: string|null,
 *   periodOfReport?: string|null,
 *   secURL?: string|null,
 *   snippet?: string|null,
 * }
 */
final class Filing implements BaseModel
{
    /** @use SdkModel<FilingShape> */
    use SdkModel;

    #[Optional]
    public ?string $accessionNumber;

    #[Optional(nullable: true)]
    public ?string $description;

    /** @var list<Document>|null $documents */
    #[Optional(list: Document::class)]
    public ?array $documents;

    #[Optional]
    public ?Entity $entity;

    #[Optional]
    public ?string $filedAt;

    #[Optional]
    public ?string $formType;

    #[Optional(nullable: true)]
    public ?string $periodOfReport;

    #[Optional('secUrl')]
    public ?string $secURL;

    #[Optional(nullable: true)]
    public ?string $snippet;

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
     * @param Entity|EntityShape|null $entity
     */
    public static function with(
        ?string $accessionNumber = null,
        ?string $description = null,
        ?array $documents = null,
        Entity|array|null $entity = null,
        ?string $filedAt = null,
        ?string $formType = null,
        ?string $periodOfReport = null,
        ?string $secURL = null,
        ?string $snippet = null,
    ): self {
        $self = new self;

        null !== $accessionNumber && $self['accessionNumber'] = $accessionNumber;
        null !== $description && $self['description'] = $description;
        null !== $documents && $self['documents'] = $documents;
        null !== $entity && $self['entity'] = $entity;
        null !== $filedAt && $self['filedAt'] = $filedAt;
        null !== $formType && $self['formType'] = $formType;
        null !== $periodOfReport && $self['periodOfReport'] = $periodOfReport;
        null !== $secURL && $self['secURL'] = $secURL;
        null !== $snippet && $self['snippet'] = $snippet;

        return $self;
    }

    public function withAccessionNumber(string $accessionNumber): self
    {
        $self = clone $this;
        $self['accessionNumber'] = $accessionNumber;

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

    /**
     * @param Entity|EntityShape $entity
     */
    public function withEntity(Entity|array $entity): self
    {
        $self = clone $this;
        $self['entity'] = $entity;

        return $self;
    }

    public function withFiledAt(string $filedAt): self
    {
        $self = clone $this;
        $self['filedAt'] = $filedAt;

        return $self;
    }

    public function withFormType(string $formType): self
    {
        $self = clone $this;
        $self['formType'] = $formType;

        return $self;
    }

    public function withPeriodOfReport(?string $periodOfReport): self
    {
        $self = clone $this;
        $self['periodOfReport'] = $periodOfReport;

        return $self;
    }

    public function withSecURL(string $secURL): self
    {
        $self = clone $this;
        $self['secURL'] = $secURL;

        return $self;
    }

    public function withSnippet(?string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }
}
