<?php

declare(strict_types=1);

namespace Casedev\Legal\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Search for legal sources including cases, statutes, and regulations from authoritative legal databases. Returns ranked candidates. Always verify with legal.verify() before citing.
 *
 * @see Casedev\Services\Legal\V1Service::find()
 *
 * @phpstan-type V1FindParamsShape = array{
 *   query: string, jurisdiction?: string|null, numResults?: int|null
 * }
 */
final class V1FindParams implements BaseModel
{
    /** @use SdkModel<V1FindParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query (e.g., "fair use copyright", "Miranda rights").
     */
    #[Required]
    public string $query;

    /**
     * Optional jurisdiction ID from resolveJurisdiction (e.g., "california", "us-federal").
     */
    #[Optional]
    public ?string $jurisdiction;

    /**
     * Number of results 1-25 (default: 10).
     */
    #[Optional]
    public ?int $numResults;

    /**
     * `new V1FindParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1FindParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1FindParams)->withQuery(...)
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
        ?string $jurisdiction = null,
        ?int $numResults = null
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $numResults && $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Search query (e.g., "fair use copyright", "Miranda rights").
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Optional jurisdiction ID from resolveJurisdiction (e.g., "california", "us-federal").
     */
    public function withJurisdiction(string $jurisdiction): self
    {
        $self = clone $this;
        $self['jurisdiction'] = $jurisdiction;

        return $self;
    }

    /**
     * Number of results 1-25 (default: 10).
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }
}
