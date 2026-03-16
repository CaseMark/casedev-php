<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Update an org-scoped custom skill by slug. Only provided fields are updated. Version is auto-incremented.
 *
 * @see CaseDev\Services\SkillsService::update()
 *
 * @phpstan-type SkillUpdateParamsShape = array{
 *   content?: string|null,
 *   metadata?: mixed,
 *   name?: string|null,
 *   slug?: string|null,
 *   summary?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class SkillUpdateParams implements BaseModel
{
    /** @use SdkModel<SkillUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $content;

    #[Optional]
    public mixed $metadata;

    #[Optional]
    public ?string $name;

    /**
     * New slug (renames the skill).
     */
    #[Optional]
    public ?string $slug;

    #[Optional(nullable: true)]
    public ?string $summary;

    /** @var list<string>|null $tags */
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
        ?string $content = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $summary && $self['summary'] = $summary;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * New slug (renames the skill).
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    public function withSummary(?string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
