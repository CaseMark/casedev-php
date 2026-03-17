<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1SecFilingParams\Type;

/**
 * Search SEC EDGAR full-text filings via efts.sec.gov or fetch a filer's structured filing history via data.sec.gov. Returns direct SEC archive URLs with filing metadata and match snippets when available.
 *
 * @see CaseDev\Services\Legal\V1Service::secFiling()
 *
 * @phpstan-type V1SecFilingParamsShape = array{
 *   type: Type|value-of<Type>,
 *   cik?: string|null,
 *   dateAfter?: string|null,
 *   dateBefore?: string|null,
 *   entity?: string|null,
 *   formTypes?: list<string>|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   query?: string|null,
 *   ticker?: string|null,
 * }
 */
final class V1SecFilingParams implements BaseModel
{
    /** @use SdkModel<V1SecFilingParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Run a full-text search or fetch a single entity filing history.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * CIK for entity lookups. Accepts padded or unpadded digits.
     */
    #[Optional]
    public ?string $cik;

    /**
     * Optional lower filing date bound (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $dateAfter;

    /**
     * Optional upper filing date bound (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $dateBefore;

    /**
     * Optional entity filter passed through to EDGAR full-text search.
     */
    #[Optional]
    public ?string $entity;

    /**
     * Optional SEC form type filter such as 10-K, 10-Q, 8-K, or 4.
     *
     * @var list<string>|null $formTypes
     */
    #[Optional(list: 'string')]
    public ?array $formTypes;

    /**
     * Maximum filings to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Result offset for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Full-text SEC search query (required for type: search).
     */
    #[Optional]
    public ?string $query;

    /**
     * Optional company ticker. Valid for both search and entity lookups.
     */
    #[Optional]
    public ?string $ticker;

    /**
     * `new V1SecFilingParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SecFilingParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SecFilingParams)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param list<string>|null $formTypes
     */
    public static function with(
        Type|string $type,
        ?string $cik = null,
        ?string $dateAfter = null,
        ?string $dateBefore = null,
        ?string $entity = null,
        ?array $formTypes = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $query = null,
        ?string $ticker = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $cik && $self['cik'] = $cik;
        null !== $dateAfter && $self['dateAfter'] = $dateAfter;
        null !== $dateBefore && $self['dateBefore'] = $dateBefore;
        null !== $entity && $self['entity'] = $entity;
        null !== $formTypes && $self['formTypes'] = $formTypes;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $query && $self['query'] = $query;
        null !== $ticker && $self['ticker'] = $ticker;

        return $self;
    }

    /**
     * Run a full-text search or fetch a single entity filing history.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * CIK for entity lookups. Accepts padded or unpadded digits.
     */
    public function withCik(string $cik): self
    {
        $self = clone $this;
        $self['cik'] = $cik;

        return $self;
    }

    /**
     * Optional lower filing date bound (YYYY-MM-DD).
     */
    public function withDateAfter(string $dateAfter): self
    {
        $self = clone $this;
        $self['dateAfter'] = $dateAfter;

        return $self;
    }

    /**
     * Optional upper filing date bound (YYYY-MM-DD).
     */
    public function withDateBefore(string $dateBefore): self
    {
        $self = clone $this;
        $self['dateBefore'] = $dateBefore;

        return $self;
    }

    /**
     * Optional entity filter passed through to EDGAR full-text search.
     */
    public function withEntity(string $entity): self
    {
        $self = clone $this;
        $self['entity'] = $entity;

        return $self;
    }

    /**
     * Optional SEC form type filter such as 10-K, 10-Q, 8-K, or 4.
     *
     * @param list<string> $formTypes
     */
    public function withFormTypes(array $formTypes): self
    {
        $self = clone $this;
        $self['formTypes'] = $formTypes;

        return $self;
    }

    /**
     * Maximum filings to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Result offset for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Full-text SEC search query (required for type: search).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Optional company ticker. Valid for both search and entity lookups.
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }
}
