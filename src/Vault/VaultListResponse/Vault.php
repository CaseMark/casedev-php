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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $description && $obj['description'] = $description;
        null !== $enableGraph && $obj['enableGraph'] = $enableGraph;
        null !== $name && $obj['name'] = $name;
        null !== $totalBytes && $obj['totalBytes'] = $totalBytes;
        null !== $totalObjects && $obj['totalObjects'] = $totalObjects;

        return $obj;
    }

    /**
     * Vault identifier.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Vault creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Vault description.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Whether GraphRAG is enabled.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $obj = clone $this;
        $obj['enableGraph'] = $enableGraph;

        return $obj;
    }

    /**
     * Vault name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Total storage size in bytes.
     */
    public function withTotalBytes(int $totalBytes): self
    {
        $obj = clone $this;
        $obj['totalBytes'] = $totalBytes;

        return $obj;
    }

    /**
     * Number of stored documents.
     */
    public function withTotalObjects(int $totalObjects): self
    {
        $obj = clone $this;
        $obj['totalObjects'] = $totalObjects;

        return $obj;
    }
}
