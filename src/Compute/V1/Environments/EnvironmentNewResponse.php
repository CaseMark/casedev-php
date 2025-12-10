<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments;

use Casedev\Compute\V1\Environments\EnvironmentNewResponse\Status;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EnvironmentNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   domain?: string|null,
 *   isDefault?: bool|null,
 *   name?: string|null,
 *   slug?: string|null,
 *   status?: value-of<Status>|null,
 * }
 */
final class EnvironmentNewResponse implements BaseModel
{
    /** @use SdkModel<EnvironmentNewResponseShape> */
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
     * Unique domain for this environment.
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
     * URL-friendly slug derived from name.
     */
    #[Optional]
    public ?string $slug;

    /**
     * Environment status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $domain = null,
        ?bool $isDefault = null,
        ?string $name = null,
        ?string $slug = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $domain && $self['domain'] = $domain;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $name && $self['name'] = $name;
        null !== $slug && $self['slug'] = $slug;
        null !== $status && $self['status'] = $status;

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
     * Unique domain for this environment.
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
     * URL-friendly slug derived from name.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Environment status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
