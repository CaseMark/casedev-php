<?php

declare(strict_types=1);

namespace Router\Format\V1\Templates\TemplateListResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type TemplateShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   name?: string|null,
 *   tags?: list<mixed>|null,
 *   type?: string|null,
 *   usageCount?: int|null,
 *   variables?: list<mixed>|null,
 * }
 */
final class Template implements BaseModel
{
    /** @use SdkModel<TemplateShape> */
    use SdkModel;

    /**
     * Unique template identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Template creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Template description.
     */
    #[Optional]
    public ?string $description;

    /**
     * Template name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Template tags for organization.
     *
     * @var list<mixed>|null $tags
     */
    #[Optional(list: 'mixed')]
    public ?array $tags;

    /**
     * Template type/category.
     */
    #[Optional]
    public ?string $type;

    /**
     * Number of times template has been used.
     */
    #[Optional]
    public ?int $usageCount;

    /**
     * Template variables for customization.
     *
     * @var list<mixed>|null $variables
     */
    #[Optional(list: 'mixed')]
    public ?array $variables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed>|null $tags
     * @param list<mixed>|null $variables
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?string $name = null,
        ?array $tags = null,
        ?string $type = null,
        ?int $usageCount = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $tags && $self['tags'] = $tags;
        null !== $type && $self['type'] = $type;
        null !== $usageCount && $self['usageCount'] = $usageCount;
        null !== $variables && $self['variables'] = $variables;

        return $self;
    }

    /**
     * Unique template identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Template creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Template description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Template name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Template tags for organization.
     *
     * @param list<mixed> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Template type/category.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Number of times template has been used.
     */
    public function withUsageCount(int $usageCount): self
    {
        $self = clone $this;
        $self['usageCount'] = $usageCount;

        return $self;
    }

    /**
     * Template variables for customization.
     *
     * @param list<mixed> $variables
     */
    public function withVariables(array $variables): self
    {
        $self = clone $this;
        $self['variables'] = $variables;

        return $self;
    }
}
