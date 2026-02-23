<?php

declare(strict_types=1);

namespace Router\Compute\V1\Environments;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type EnvironmentGetResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   domain?: string|null,
 *   isDefault?: bool|null,
 *   name?: string|null,
 *   slug?: string|null,
 *   status?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class EnvironmentGetResponse implements BaseModel
{
    /** @use SdkModel<EnvironmentGetResponseShape> */
    use SdkModel;

    /**
     * Unique environment identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Environment creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Environment domain URL.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Whether this is the default environment.
     */
    #[Optional]
    public ?bool $isDefault;

    /**
     * Environment name.
     */
    #[Optional]
    public ?string $name;

    /**
     * URL-safe environment slug.
     */
    #[Optional]
    public ?string $slug;

    /**
     * Environment status (active, inactive, etc.).
     */
    #[Optional]
    public ?string $status;

    /**
     * Environment last update timestamp.
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
        ?\DateTimeInterface $createdAt = null,
        ?string $domain = null,
        ?bool $isDefault = null,
        ?string $name = null,
        ?string $slug = null,
        ?string $status = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $domain && $self['domain'] = $domain;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $status && $self['status'] = $status;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Unique environment identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Environment creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Environment domain URL.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Whether this is the default environment.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * Environment name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * URL-safe environment slug.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Environment status (active, inactive, etc.).
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Environment last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
