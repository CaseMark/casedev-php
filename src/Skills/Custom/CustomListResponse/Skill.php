<?php

declare(strict_types=1);

namespace CaseDev\Skills\Custom\CustomListResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SkillShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   metadata?: mixed,
 *   name?: string|null,
 *   slug?: string|null,
 *   summary?: string|null,
 *   tags?: list<string>|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   version?: int|null,
 * }
 */
final class Skill implements BaseModel
{
    /** @use SdkModel<SkillShape> */
    use SdkModel;

    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    #[Optional]
    public mixed $metadata;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $slug;

    #[Optional(nullable: true)]
    public ?string $summary;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    #[Optional('updated_at')]
    public ?\DateTimeInterface $updatedAt;

    #[Optional]
    public ?int $version;

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
        ?\DateTimeInterface $createdAt = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
        ?\DateTimeInterface $updatedAt = null,
        ?int $version = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $summary && $self['summary'] = $summary;
        null !== $tags && $self['tags'] = $tags;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $version && $self['version'] = $version;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withVersion(int $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
