<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SkillReadResponseShape = array{
 *   authorName?: string|null,
 *   content?: string|null,
 *   license?: string|null,
 *   name?: string|null,
 *   slug?: string|null,
 *   summary?: string|null,
 *   tags?: list<string>|null,
 *   version?: string|null,
 * }
 */
final class SkillReadResponse implements BaseModel
{
    /** @use SdkModel<SkillReadResponseShape> */
    use SdkModel;

    /**
     * Skill author.
     */
    #[Optional('author_name')]
    public ?string $authorName;

    /**
     * Full skill content in markdown.
     */
    #[Optional]
    public ?string $content;

    /**
     * Skill license.
     */
    #[Optional]
    public ?string $license;

    /**
     * Skill name.
     */
    #[Optional]
    public ?string $name;

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

    /**
     * Skill version.
     */
    #[Optional]
    public ?string $version;

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
        ?string $authorName = null,
        ?string $content = null,
        ?string $license = null,
        ?string $name = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
        ?string $version = null,
    ): self {
        $self = new self;

        null !== $authorName && $self['authorName'] = $authorName;
        null !== $content && $self['content'] = $content;
        null !== $license && $self['license'] = $license;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $summary && $self['summary'] = $summary;
        null !== $tags && $self['tags'] = $tags;
        null !== $version && $self['version'] = $version;

        return $self;
    }

    /**
     * Skill author.
     */
    public function withAuthorName(string $authorName): self
    {
        $self = clone $this;
        $self['authorName'] = $authorName;

        return $self;
    }

    /**
     * Full skill content in markdown.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Skill license.
     */
    public function withLicense(string $license): self
    {
        $self = clone $this;
        $self['license'] = $license;

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

    /**
     * Skill version.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
