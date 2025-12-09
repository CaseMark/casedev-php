<?php

declare(strict_types=1);

namespace Casedev\Search\V1\V1AnswerResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CitationShape = array{
 *   id?: string|null,
 *   publishedDate?: string|null,
 *   text?: string|null,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Citation implements BaseModel
{
    /** @use SdkModel<CitationShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $publishedDate;

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
        ?string $id = null,
        ?string $publishedDate = null,
        ?string $text = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $publishedDate && $obj['publishedDate'] = $publishedDate;
        null !== $text && $obj['text'] = $text;
        null !== $title && $obj['title'] = $title;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withPublishedDate(string $publishedDate): self
    {
        $obj = clone $this;
        $obj['publishedDate'] = $publishedDate;

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
