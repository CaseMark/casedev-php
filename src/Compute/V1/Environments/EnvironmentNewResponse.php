<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments;

use Casedev\Compute\V1\Environments\EnvironmentNewResponse\Status;
use Casedev\Core\Attributes\Api;
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
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Environment creation timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Unique domain for this environment.
     */
    #[Api(optional: true)]
    public ?string $domain;

    /**
     * Whether this is the default environment.
     */
    #[Api(optional: true)]
    public ?bool $isDefault;

    /**
     * Environment name.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * URL-friendly slug derived from name.
     */
    #[Api(optional: true)]
    public ?string $slug;

    /**
     * Environment status.
     *
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $domain && $obj['domain'] = $domain;
        null !== $isDefault && $obj['isDefault'] = $isDefault;
        null !== $name && $obj['name'] = $name;
        null !== $slug && $obj['slug'] = $slug;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Unique environment identifier.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Environment creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Unique domain for this environment.
     */
    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj['domain'] = $domain;

        return $obj;
    }

    /**
     * Whether this is the default environment.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $obj = clone $this;
        $obj['isDefault'] = $isDefault;

        return $obj;
    }

    /**
     * Environment name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * URL-friendly slug derived from name.
     */
    public function withSlug(string $slug): self
    {
        $obj = clone $this;
        $obj['slug'] = $slug;

        return $obj;
    }

    /**
     * Environment status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
