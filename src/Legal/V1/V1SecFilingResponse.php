<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1SecFilingResponse\Filing;
use CaseDev\Legal\V1\V1SecFilingResponse\Type;

/**
 * @phpstan-import-type FilingShape from \CaseDev\Legal\V1\V1SecFilingResponse\Filing
 *
 * @phpstan-type V1SecFilingResponseShape = array{
 *   cik?: string|null,
 *   dateAfter?: string|null,
 *   dateBefore?: string|null,
 *   entity?: string|null,
 *   filings?: list<Filing|FilingShape>|null,
 *   formTypes?: list<string>|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   query?: string|null,
 *   ticker?: string|null,
 *   total?: int|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class V1SecFilingResponse implements BaseModel
{
    /** @use SdkModel<V1SecFilingResponseShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $cik;

    #[Optional(nullable: true)]
    public ?string $dateAfter;

    #[Optional(nullable: true)]
    public ?string $dateBefore;

    #[Optional(nullable: true)]
    public ?string $entity;

    /** @var list<Filing>|null $filings */
    #[Optional(list: Filing::class)]
    public ?array $filings;

    /** @var list<string>|null $formTypes */
    #[Optional(list: 'string')]
    public ?array $formTypes;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?int $offset;

    #[Optional(nullable: true)]
    public ?string $query;

    #[Optional(nullable: true)]
    public ?string $ticker;

    #[Optional]
    public ?int $total;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Filing|FilingShape>|null $filings
     * @param list<string>|null $formTypes
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $cik = null,
        ?string $dateAfter = null,
        ?string $dateBefore = null,
        ?string $entity = null,
        ?array $filings = null,
        ?array $formTypes = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $query = null,
        ?string $ticker = null,
        ?int $total = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $cik && $self['cik'] = $cik;
        null !== $dateAfter && $self['dateAfter'] = $dateAfter;
        null !== $dateBefore && $self['dateBefore'] = $dateBefore;
        null !== $entity && $self['entity'] = $entity;
        null !== $filings && $self['filings'] = $filings;
        null !== $formTypes && $self['formTypes'] = $formTypes;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $query && $self['query'] = $query;
        null !== $ticker && $self['ticker'] = $ticker;
        null !== $total && $self['total'] = $total;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withCik(?string $cik): self
    {
        $self = clone $this;
        $self['cik'] = $cik;

        return $self;
    }

    public function withDateAfter(?string $dateAfter): self
    {
        $self = clone $this;
        $self['dateAfter'] = $dateAfter;

        return $self;
    }

    public function withDateBefore(?string $dateBefore): self
    {
        $self = clone $this;
        $self['dateBefore'] = $dateBefore;

        return $self;
    }

    public function withEntity(?string $entity): self
    {
        $self = clone $this;
        $self['entity'] = $entity;

        return $self;
    }

    /**
     * @param list<Filing|FilingShape> $filings
     */
    public function withFilings(array $filings): self
    {
        $self = clone $this;
        $self['filings'] = $filings;

        return $self;
    }

    /**
     * @param list<string> $formTypes
     */
    public function withFormTypes(array $formTypes): self
    {
        $self = clone $this;
        $self['formTypes'] = $formTypes;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    public function withQuery(?string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    public function withTicker(?string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
