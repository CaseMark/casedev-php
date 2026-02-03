<?php

declare(strict_types=1);

namespace Casedev\Legal\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Legal\V1\V1GetCitationsFromURLResponse\Citations;

/**
 * @phpstan-import-type CitationsShape from \Casedev\Legal\V1\V1GetCitationsFromURLResponse\Citations
 *
 * @phpstan-type V1GetCitationsFromURLResponseShape = array{
 *   citations?: null|Citations|CitationsShape,
 *   externalLinks?: list<string>|null,
 *   hint?: string|null,
 *   title?: string|null,
 *   totalCitations?: int|null,
 *   url?: string|null,
 * }
 */
final class V1GetCitationsFromURLResponse implements BaseModel
{
    /** @use SdkModel<V1GetCitationsFromURLResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Citations $citations;

    /**
     * External links found in the document.
     *
     * @var list<string>|null $externalLinks
     */
    #[Optional(list: 'string')]
    public ?array $externalLinks;

    /**
     * Usage guidance.
     */
    #[Optional]
    public ?string $hint;

    /**
     * Document title.
     */
    #[Optional]
    public ?string $title;

    /**
     * Total citations found.
     */
    #[Optional]
    public ?int $totalCitations;

    /**
     * Source document URL.
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
     *
     * @param Citations|CitationsShape|null $citations
     * @param list<string>|null $externalLinks
     */
    public static function with(
        Citations|array|null $citations = null,
        ?array $externalLinks = null,
        ?string $hint = null,
        ?string $title = null,
        ?int $totalCitations = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $citations && $self['citations'] = $citations;
        null !== $externalLinks && $self['externalLinks'] = $externalLinks;
        null !== $hint && $self['hint'] = $hint;
        null !== $title && $self['title'] = $title;
        null !== $totalCitations && $self['totalCitations'] = $totalCitations;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * @param Citations|CitationsShape $citations
     */
    public function withCitations(Citations|array $citations): self
    {
        $self = clone $this;
        $self['citations'] = $citations;

        return $self;
    }

    /**
     * External links found in the document.
     *
     * @param list<string> $externalLinks
     */
    public function withExternalLinks(array $externalLinks): self
    {
        $self = clone $this;
        $self['externalLinks'] = $externalLinks;

        return $self;
    }

    /**
     * Usage guidance.
     */
    public function withHint(string $hint): self
    {
        $self = clone $this;
        $self['hint'] = $hint;

        return $self;
    }

    /**
     * Document title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Total citations found.
     */
    public function withTotalCitations(int $totalCitations): self
    {
        $self = clone $this;
        $self['totalCitations'] = $totalCitations;

        return $self;
    }

    /**
     * Source document URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
