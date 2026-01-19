<?php

declare(strict_types=1);

namespace Casedev\Search\V1\V1GetResearchResponse\Results;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1GetResearchResponse\Results\Section\Source;

/**
 * @phpstan-import-type SourceShape from \Casedev\Search\V1\V1GetResearchResponse\Results\Section\Source
 *
 * @phpstan-type SectionShape = array{
 *   content?: string|null,
 *   sources?: list<\Casedev\Search\V1\V1GetResearchResponse\Results\Section\Source|SourceShape>|null,
 *   title?: string|null,
 * }
 */
final class Section implements BaseModel
{
    /** @use SdkModel<SectionShape> */
    use SdkModel;

    #[Optional]
    public ?string $content;

    /**
     * @var list<Source>|null $sources
     */
    #[Optional(
        list: Source::class
    )]
    public ?array $sources;

    #[Optional]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Source|SourceShape>|null $sources
     */
    public static function with(
        ?string $content = null,
        ?array $sources = null,
        ?string $title = null
    ): self {
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $sources && $self['sources'] = $sources;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * @param list<Source|SourceShape> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
