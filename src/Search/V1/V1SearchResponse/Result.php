<?php

declare(strict_types=1);

namespace Casedev\Search\V1\V1SearchResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   domain?: string|null,
 *   publishedDate?: \DateTimeInterface|null,
 *   snippet?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Domain of the source.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Publication date of the content.
     */
    #[Optional]
    public ?\DateTimeInterface $publishedDate;

    /**
     * Brief excerpt from the content.
     */
    #[Optional]
    public ?string $snippet;

    /**
     * Title of the search result.
     */
    #[Optional]
    public ?string $title;

    /**
     * URL of the search result.
     */
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
        ?\DateTimeInterface $publishedDate = null,
        ?string $snippet = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $domain && $obj['domain'] = $domain;
        null !== $publishedDate && $obj['publishedDate'] = $publishedDate;
        null !== $snippet && $obj['snippet'] = $snippet;
        null !== $title && $obj['title'] = $title;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    /**
     * Domain of the source.
     */
    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj['domain'] = $domain;

        return $obj;
    }

    /**
     * Publication date of the content.
     */
    public function withPublishedDate(\DateTimeInterface $publishedDate): self
    {
        $obj = clone $this;
        $obj['publishedDate'] = $publishedDate;

        return $obj;
    }

    /**
     * Brief excerpt from the content.
     */
    public function withSnippet(string $snippet): self
    {
        $obj = clone $this;
        $obj['snippet'] = $snippet;

        return $obj;
    }

    /**
     * Title of the search result.
     */
    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }

    /**
     * URL of the search result.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
