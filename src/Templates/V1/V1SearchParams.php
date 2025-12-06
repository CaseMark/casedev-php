<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Perform semantic search across available workflows to find the most relevant pre-built document processing pipelines for your legal use case.
 *
 * @see Casedev\Services\Templates\V1Service::search()
 *
 * @phpstan-type V1SearchParamsShape = array{
 *   query: string, category?: string, limit?: int
 * }
 */
final class V1SearchParams implements BaseModel
{
    /** @use SdkModel<V1SearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query to find relevant workflows.
     */
    #[Api]
    public string $query;

    /**
     * Optional category filter to narrow results.
     */
    #[Api(optional: true)]
    public ?string $category;

    /**
     * Maximum number of results to return (default: 10, max: 50).
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * `new V1SearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SearchParams)->withQuery(...)
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
     */
    public static function with(
        string $query,
        ?string $category = null,
        ?int $limit = null
    ): self {
        $obj = new self;

        $obj['query'] = $query;

        null !== $category && $obj['category'] = $category;
        null !== $limit && $obj['limit'] = $limit;

        return $obj;
    }

    /**
     * Search query to find relevant workflows.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * Optional category filter to narrow results.
     */
    public function withCategory(string $category): self
    {
        $obj = clone $this;
        $obj['category'] = $category;

        return $obj;
    }

    /**
     * Maximum number of results to return (default: 10, max: 50).
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj['limit'] = $limit;

        return $obj;
    }
}
