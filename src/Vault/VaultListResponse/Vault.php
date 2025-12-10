<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultListResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VaultShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   name?: string|null,
 *   totalBytes?: int|null,
 *   totalObjects?: int|null,
 * }
 */
final class Vault implements BaseModel
{
    /** @use SdkModel<VaultShape> */
    use SdkModel;

    /**
     * Vault identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Vault creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Vault description.
     */
    #[Optional]
    public ?string $description;

    /**
     * Whether GraphRAG is enabled.
     */
    #[Optional]
    public ?bool $enableGraph;

    /**
     * Vault name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Total storage size in bytes.
     */
    #[Optional]
    public ?int $totalBytes;

    /**
     * Number of stored documents.
     */
    #[Optional]
    public ?int $totalObjects;

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
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $name = null,
        ?int $totalBytes = null,
        ?int $totalObjects = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $name && $self['name'] = $name;
        null !== $totalBytes && $self['totalBytes'] = $totalBytes;
        null !== $totalObjects && $self['totalObjects'] = $totalObjects;

        return $self;
    }

    /**
     * Vault identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Vault creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Vault description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Whether GraphRAG is enabled.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $self = clone $this;
        $self['enableGraph'] = $enableGraph;

        return $self;
    }

    /**
     * Vault name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Total storage size in bytes.
     */
    public function withTotalBytes(int $totalBytes): self
    {
        $self = clone $this;
        $self['totalBytes'] = $totalBytes;

        return $self;
    }

    /**
     * Number of stored documents.
     */
    public function withTotalObjects(int $totalObjects): self
    {
        $self = clone $this;
        $self['totalObjects'] = $totalObjects;

        return $self;
    }
}
