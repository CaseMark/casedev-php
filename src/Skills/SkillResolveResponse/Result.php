<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillResolveResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   name?: string|null,
 *   score?: float|null,
 *   slug?: string|null,
 *   summary?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Skill name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Relevance score.
     */
    #[Optional]
    public ?float $score;

    /**
     * Unique skill identifier.
     */
    #[Optional]
    public ?string $slug;

    /**
     * Brief skill description.
     */
    #[Optional]
    public ?string $summary;

    /**
     * Skill tags.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $name = null,
        ?float $score = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        null !== $name && $self['name'] = $name;
        null !== $score && $self['score'] = $score;
        null !== $slug && $self['slug'] = $slug;
        null !== $summary && $self['summary'] = $summary;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Skill name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Relevance score.
     */
    public function withScore(float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Unique skill identifier.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Brief skill description.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Skill tags.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
