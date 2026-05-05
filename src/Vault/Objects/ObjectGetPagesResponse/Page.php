<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectGetPagesResponse;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PageShape = array{page: int, text: string}
 */
final class Page implements BaseModel
{
    /** @use SdkModel<PageShape> */
    use SdkModel;

    /**
     * Page number (1-indexed).
     */
    #[Required]
    public int $page;

    /**
     * OCR text for this page.
     */
    #[Required]
    public string $text;

    /**
     * `new Page()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Page::with(page: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Page)->withPage(...)->withText(...)
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
    public static function with(int $page, string $text): self
    {
        $self = new self;

        $self['page'] = $page;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Page number (1-indexed).
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * OCR text for this page.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
