<?php

declare(strict_types=1);

namespace Casedev\Search\V1\V1SimilarResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   domain?: string|null,
 *   publishedDate?: string|null,
 *   similarityScore?: float|null,
 *   snippet?: string|null,
 *   text?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    #[Optional]
    public ?string $domain;

    #[Optional]
    public ?string $publishedDate;

    #[Optional]
    public ?float $similarityScore;

    #[Optional]
    public ?string $snippet;

    #[Optional]
    public ?string $text;

    #[Optional]
    public ?string $title;

    #[Optional]
    public ?string $url;

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
        ?string $domain = null,
        ?string $publishedDate = null,
        ?float $similarityScore = null,
        ?string $snippet = null,
        ?string $text = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $domain && $self['domain'] = $domain;
        null !== $publishedDate && $self['publishedDate'] = $publishedDate;
        null !== $similarityScore && $self['similarityScore'] = $similarityScore;
        null !== $snippet && $self['snippet'] = $snippet;
        null !== $text && $self['text'] = $text;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    public function withPublishedDate(string $publishedDate): self
    {
        $self = clone $this;
        $self['publishedDate'] = $publishedDate;

        return $self;
    }

    public function withSimilarityScore(float $similarityScore): self
    {
        $self = clone $this;
        $self['similarityScore'] = $similarityScore;

        return $self;
    }

    public function withSnippet(string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
