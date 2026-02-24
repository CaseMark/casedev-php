<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Find cases and documents similar to a given legal source. Useful for finding citing cases, related precedents, or similar statutes.
 *
 * @see CaseDev\Services\Legal\V1Service::similar()
 *
 * @phpstan-type V1SimilarParamsShape = array{
 *   url: string,
 *   jurisdiction?: string|null,
 *   numResults?: int|null,
 *   startPublishedDate?: string|null,
 * }
 */
final class V1SimilarParams implements BaseModel
{
    /** @use SdkModel<V1SimilarParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL of a legal document to find similar sources for.
     */
    #[Required]
    public string $url;

    /**
     * Optional jurisdiction ID to filter results.
     */
    #[Optional]
    public ?string $jurisdiction;

    /**
     * Number of results 1-25 (default: 10).
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Optional ISO date to find only newer documents (e.g., "2020-01-01").
     */
    #[Optional]
    public ?string $startPublishedDate;

    /**
     * `new V1SimilarParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SimilarParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SimilarParams)->withURL(...)
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
        string $url,
        ?string $jurisdiction = null,
        ?int $numResults = null,
        ?string $startPublishedDate = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $jurisdiction && $self['jurisdiction'] = $jurisdiction;
        null !== $numResults && $self['numResults'] = $numResults;
        null !== $startPublishedDate && $self['startPublishedDate'] = $startPublishedDate;

        return $self;
    }

    /**
     * URL of a legal document to find similar sources for.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional jurisdiction ID to filter results.
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

    /**
     * Optional ISO date to find only newer documents (e.g., "2020-01-01").
     */
    public function withStartPublishedDate(string $startPublishedDate): self
    {
        $self = clone $this;
        $self['startPublishedDate'] = $startPublishedDate;

        return $self;
    }
}
