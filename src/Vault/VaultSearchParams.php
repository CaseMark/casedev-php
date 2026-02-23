<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Vault\VaultSearchParams\Filters;
use Router\Vault\VaultSearchParams\Method;

/**
 * Search across vault documents using multiple methods including hybrid vector + graph search, GraphRAG global search, entity-based search, and fast similarity search. Returns relevant documents and contextual answers based on the search method.
 *
 * @see Router\Services\VaultService::search()
 *
 * @phpstan-import-type FiltersShape from \Router\Vault\VaultSearchParams\Filters
 *
 * @phpstan-type VaultSearchParamsShape = array{
 *   query: string,
 *   filters?: null|Filters|FiltersShape,
 *   method?: null|Method|value-of<Method>,
 *   topK?: int|null,
 * }
 */
final class VaultSearchParams implements BaseModel
{
    /** @use SdkModel<VaultSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query or question to find relevant documents.
     */
    #[Required]
    public string $query;

    /**
     * Filters to narrow search results to specific documents.
     */
    #[Optional]
    public ?Filters $filters;

    /**
     * Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach.
     *
     * @var value-of<Method>|null $method
     */
    #[Optional(enum: Method::class)]
    public ?string $method;

    /**
     * Maximum number of results to return.
     */
    #[Optional]
    public ?int $topK;

    /**
     * `new VaultSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultSearchParams)->withQuery(...)
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
     * @param Filters|FiltersShape|null $filters
     * @param Method|value-of<Method>|null $method
     */
    public static function with(
        string $query,
        Filters|array|null $filters = null,
        Method|string|null $method = null,
        ?int $topK = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $filters && $self['filters'] = $filters;
        null !== $method && $self['method'] = $method;
        null !== $topK && $self['topK'] = $topK;

        return $self;
    }

    /**
     * Search query or question to find relevant documents.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Filters to narrow search results to specific documents.
     *
     * @param Filters|FiltersShape $filters
     */
    public function withFilters(Filters|array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }

    /**
     * Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach.
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * Maximum number of results to return.
     */
    public function withTopK(int $topK): self
    {
        $self = clone $this;
        $self['topK'] = $topK;

        return $self;
    }
}
