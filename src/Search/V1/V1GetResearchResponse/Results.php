<?php

declare(strict_types=1);

namespace Router\Search\V1\V1GetResearchResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Search\V1\V1GetResearchResponse\Results\Section;
use Router\Search\V1\V1GetResearchResponse\Results\Source;

/**
 * Research findings and analysis.
 *
 * @phpstan-import-type SectionShape from \Router\Search\V1\V1GetResearchResponse\Results\Section
 * @phpstan-import-type SourceShape from \Router\Search\V1\V1GetResearchResponse\Results\Source
 *
 * @phpstan-type ResultsShape = array{
 *   sections?: list<Section|SectionShape>|null,
 *   sources?: list<Source|SourceShape>|null,
 *   summary?: string|null,
 * }
 */
final class Results implements BaseModel
{
    /** @use SdkModel<ResultsShape> */
    use SdkModel;

    /**
     * Detailed research sections.
     *
     * @var list<Section>|null $sections
     */
    #[Optional(list: Section::class)]
    public ?array $sections;

    /**
     * All sources referenced in research.
     *
     * @var list<Source>|null $sources
     */
    #[Optional(list: Source::class)]
    public ?array $sources;

    /**
     * Executive summary of research findings.
     */
    #[Optional]
    public ?string $summary;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Section|SectionShape>|null $sections
     * @param list<Source|SourceShape>|null $sources
     */
    public static function with(
        ?array $sections = null,
        ?array $sources = null,
        ?string $summary = null
    ): self {
        $self = new self;

        null !== $sections && $self['sections'] = $sections;
        null !== $sources && $self['sources'] = $sources;
        null !== $summary && $self['summary'] = $summary;

        return $self;
    }

    /**
     * Detailed research sections.
     *
     * @param list<Section|SectionShape> $sections
     */
    public function withSections(array $sections): self
    {
        $self = clone $this;
        $self['sections'] = $sections;

        return $self;
    }

    /**
     * All sources referenced in research.
     *
     * @param list<Source|SourceShape> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * Executive summary of research findings.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
