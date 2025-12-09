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
        $obj = new self;

        null !== $domain && $obj['domain'] = $domain;
        null !== $publishedDate && $obj['publishedDate'] = $publishedDate;
        null !== $similarityScore && $obj['similarityScore'] = $similarityScore;
        null !== $snippet && $obj['snippet'] = $snippet;
        null !== $text && $obj['text'] = $text;
        null !== $title && $obj['title'] = $title;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj['domain'] = $domain;

        return $obj;
    }

    public function withPublishedDate(string $publishedDate): self
    {
        $obj = clone $this;
        $obj['publishedDate'] = $publishedDate;

        return $obj;
    }

    public function withSimilarityScore(float $similarityScore): self
    {
        $obj = clone $this;
        $obj['similarityScore'] = $similarityScore;

        return $obj;
    }

    public function withSnippet(string $snippet): self
    {
        $obj = clone $this;
        $obj['snippet'] = $snippet;

        return $obj;
    }

    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }

    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
