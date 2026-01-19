<?php

declare(strict_types=1);

namespace Casedev\Format\V1\Templates;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type TemplateGetResponseShape = array{
 *   id?: string|null,
 *   content?: mixed,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   name?: string|null,
 *   organizationID?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class TemplateGetResponse implements BaseModel
{
    /** @use SdkModel<TemplateGetResponseShape> */
    use SdkModel;

    /**
     * Unique template identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Template formatting rules and structure.
     */
    #[Optional]
    public mixed $content;

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
     * Organization ID that owns the template.
     */
    #[Optional('organizationId')]
    public ?string $organizationID;

    /**
     * Template last modification timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $id = null,
        mixed $content = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?string $name = null,
        ?string $organizationID = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $content && $self['content'] = $content;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $organizationID && $self['organizationID'] = $organizationID;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

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
     * Template formatting rules and structure.
     */
    public function withContent(mixed $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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
     * Organization ID that owns the template.
     */
    public function withOrganizationID(string $organizationID): self
    {
        $self = clone $this;
        $self['organizationID'] = $organizationID;

        return $self;
    }

    /**
     * Template last modification timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
