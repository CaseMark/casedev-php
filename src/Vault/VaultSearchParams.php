<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultSearchParams\Method;

/**
 * Search across vault documents using multiple methods including hybrid vector + graph search, GraphRAG global search, entity-based search, and fast similarity search. Returns relevant documents and contextual answers based on the search method.
 *
 * @see Casedev\Services\VaultService::search()
 *
 * @phpstan-type VaultSearchParamsShape = array{
 *   query: string,
 *   filters?: array<string,mixed>,
 *   method?: Method|value-of<Method>,
 *   topK?: int,
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
    #[Api]
    public string $query;

    /**
     * Additional filters to apply to search results.
     *
     * @var array<string,mixed>|null $filters
     */
    #[Api(map: 'mixed', optional: true)]
    public ?array $filters;

    /**
     * Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach.
     *
     * @var value-of<Method>|null $method
     */
    #[Api(enum: Method::class, optional: true)]
    public ?string $method;

    /**
     * Maximum number of results to return.
     */
    #[Api(optional: true)]
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
     * @param array<string,mixed> $filters
     * @param Method|value-of<Method> $method
     */
    public static function with(
        string $query,
        ?array $filters = null,
        Method|string|null $method = null,
        ?int $topK = null,
    ): self {
        $obj = new self;

        $obj['query'] = $query;

        null !== $filters && $obj['filters'] = $filters;
        null !== $method && $obj['method'] = $method;
        null !== $topK && $obj['topK'] = $topK;

        return $obj;
    }

    /**
     * Search query or question to find relevant documents.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * Additional filters to apply to search results.
     *
     * @param array<string,mixed> $filters
     */
    public function withFilters(array $filters): self
    {
        $obj = clone $this;
        $obj['filters'] = $filters;

        return $obj;
    }

    /**
     * Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach.
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $obj = clone $this;
        $obj['method'] = $method;

        return $obj;
    }

    /**
     * Maximum number of results to return.
     */
    public function withTopK(int $topK): self
    {
        $obj = clone $this;
        $obj['topK'] = $topK;

        return $obj;
    }
}
