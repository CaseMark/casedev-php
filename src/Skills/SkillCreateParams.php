<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Create an org-scoped custom skill. The skill will be searchable via /skills/resolve alongside curated skills.
 *
 * @see CaseDev\Services\SkillsService::create()
 *
 * @phpstan-type SkillCreateParamsShape = array{
 *   content: string,
 *   name: string,
 *   metadata?: mixed,
 *   slug?: string|null,
 *   summary?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class SkillCreateParams implements BaseModel
{
    /** @use SdkModel<SkillCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full skill content in markdown.
     */
    #[Required]
    public string $content;

    /**
     * Skill name.
     */
    #[Required]
    public string $name;

    /**
     * Arbitrary metadata (author, license, etc.).
     */
    #[Optional]
    public mixed $metadata;

    /**
     * URL-safe slug. Auto-generated from name if omitted.
     */
    #[Optional]
    public ?string $slug;

    /**
     * Brief description (1-2 sentences).
     */
    #[Optional]
    public ?string $summary;

    /**
     * Tags for categorization and search boosting.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new SkillCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SkillCreateParams::with(content: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SkillCreateParams)->withContent(...)->withName(...)
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
     *
     * @param list<string>|null $tags
     */
    public static function with(
        string $content,
        string $name,
        mixed $metadata = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['name'] = $name;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $slug && $self['slug'] = $slug;
        null !== $summary && $self['summary'] = $summary;
        null !== $tags && $self['tags'] = $tags;

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
     * Skill name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Arbitrary metadata (author, license, etc.).
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * URL-safe slug. Auto-generated from name if omitted.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Brief description (1-2 sentences).
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Tags for categorization and search boosting.
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
