<?php

declare(strict_types=1);

namespace Casedev\Projects\V1\V1ListResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1ListResponse\Project\SourceType;

/**
 * @phpstan-type ProjectShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   framework?: string|null,
 *   name?: string|null,
 *   slug?: string|null,
 *   sourceType?: null|SourceType|value-of<SourceType>,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $createdAt;

    #[Optional]
    public ?string $framework;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $slug;

    /** @var value-of<SourceType>|null $sourceType */
    #[Optional(enum: SourceType::class)]
    public ?string $sourceType;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SourceType|value-of<SourceType>|null $sourceType
     */
    public static function with(
        ?string $id = null,
        ?string $createdAt = null,
        ?string $framework = null,
        ?string $name = null,
        ?string $slug = null,
        SourceType|string|null $sourceType = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $framework && $self['framework'] = $framework;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $sourceType && $self['sourceType'] = $sourceType;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

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

    /**
     * @param SourceType|value-of<SourceType> $sourceType
     */
    public function withSourceType(SourceType|string $sourceType): self
    {
        $self = clone $this;
        $self['sourceType'] = $sourceType;

        return $self;
    }
}
