<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VaultNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   enableIndexing?: bool|null,
 *   filesBucket?: string|null,
 *   indexName?: string|null,
 *   name?: string|null,
 *   region?: string|null,
 *   vectorBucket?: string|null,
 * }
 */
final class VaultNewResponse implements BaseModel
{
    /** @use SdkModel<VaultNewResponseShape> */
    use SdkModel;

    /**
     * Unique vault identifier.
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
     * Whether vector indexing is enabled for this vault.
     */
    #[Optional]
    public ?bool $enableIndexing;

    /**
     * S3 bucket name for document storage.
     */
    #[Optional]
    public ?string $filesBucket;

    /**
     * Vector search index name. Null for storage-only vaults.
     */
    #[Optional(nullable: true)]
    public ?string $indexName;

    /**
     * Vault display name.
     */
    #[Optional]
    public ?string $name;

    /**
     * AWS region for storage.
     */
    #[Optional]
    public ?string $region;

    /**
     * S3 bucket name for vector embeddings. Null for storage-only vaults.
     */
    #[Optional(nullable: true)]
    public ?string $vectorBucket;

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
        ?bool $enableIndexing = null,
        ?string $filesBucket = null,
        ?string $indexName = null,
        ?string $name = null,
        ?string $region = null,
        ?string $vectorBucket = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $enableIndexing && $self['enableIndexing'] = $enableIndexing;
        null !== $filesBucket && $self['filesBucket'] = $filesBucket;
        null !== $indexName && $self['indexName'] = $indexName;
        null !== $name && $self['name'] = $name;
        null !== $region && $self['region'] = $region;
        null !== $vectorBucket && $self['vectorBucket'] = $vectorBucket;

        return $self;
    }

    /**
     * Unique vault identifier.
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
     * Whether vector indexing is enabled for this vault.
     */
    public function withEnableIndexing(bool $enableIndexing): self
    {
        $self = clone $this;
        $self['enableIndexing'] = $enableIndexing;

        return $self;
    }

    /**
     * S3 bucket name for document storage.
     */
    public function withFilesBucket(string $filesBucket): self
    {
        $self = clone $this;
        $self['filesBucket'] = $filesBucket;

        return $self;
    }

    /**
     * Vector search index name. Null for storage-only vaults.
     */
    public function withIndexName(?string $indexName): self
    {
        $self = clone $this;
        $self['indexName'] = $indexName;

        return $self;
    }

    /**
     * Vault display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * AWS region for storage.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * S3 bucket name for vector embeddings. Null for storage-only vaults.
     */
    public function withVectorBucket(?string $vectorBucket): self
    {
        $self = clone $this;
        $self['vectorBucket'] = $vectorBucket;

        return $self;
    }
}
