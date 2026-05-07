<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember1;
use CaseDev\Skills\SkillReadResponse\Source;

/**
 * @phpstan-import-type BundleVariants from \CaseDev\Skills\SkillReadResponse\Bundle
 * @phpstan-import-type BundleShape from \CaseDev\Skills\SkillReadResponse\Bundle
 *
 * @phpstan-type SkillReadResponseShape = array{
 *   authorName?: string|null,
 *   bundle?: BundleShape|null,
 *   content?: string|null,
 *   license?: string|null,
 *   metadata?: mixed,
 *   name?: string|null,
 *   slug?: string|null,
 *   source?: null|Source|value-of<Source>,
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
     * Skill bundle metadata for root skills and companion file rows.
     *
     * @var BundleVariants|null $bundle
     */
    #[Optional(nullable: true)]
    public UnionMember0|UnionMember1|null $bundle;

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
     * Custom metadata (custom skills only).
     */
    #[Optional]
    public mixed $metadata;

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
     * Skill source (authenticated requests only).
     *
     * @var value-of<Source>|null $source
     */
    #[Optional(enum: Source::class)]
    public ?string $source;

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
     * @param BundleShape|null $bundle
     * @param Source|value-of<Source>|null $source
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $authorName = null,
        UnionMember0|array|UnionMember1|null $bundle = null,
        ?string $content = null,
        ?string $license = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $slug = null,
        Source|string|null $source = null,
        ?string $summary = null,
        ?array $tags = null,
        ?string $version = null,
    ): self {
        $self = new self;

        null !== $authorName && $self['authorName'] = $authorName;
        null !== $bundle && $self['bundle'] = $bundle;
        null !== $content && $self['content'] = $content;
        null !== $license && $self['license'] = $license;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $source && $self['source'] = $source;
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
     * Skill bundle metadata for root skills and companion file rows.
     *
     * @param BundleShape|null $bundle
     */
    public function withBundle(
        UnionMember0|array|UnionMember1|null $bundle
    ): self {
        $self = clone $this;
        $self['bundle'] = $bundle;

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
     * Custom metadata (custom skills only).
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

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
     * Skill source (authenticated requests only).
     *
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

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
