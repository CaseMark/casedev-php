<?php

declare(strict_types=1);

namespace CaseDev\Search\V1\V1AnswerResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

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
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $publishedDate && $self['publishedDate'] = $publishedDate;
        null !== $text && $self['text'] = $text;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withPublishedDate(string $publishedDate): self
    {
        $self = clone $this;
        $self['publishedDate'] = $publishedDate;

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
