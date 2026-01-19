<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultGetResponse\ChunkStrategy;

/**
 * @phpstan-import-type ChunkStrategyShape from \Casedev\Vault\VaultGetResponse\ChunkStrategy
 *
 * @phpstan-type VaultGetResponseShape = array{
 *   id?: string|null,
 *   chunkStrategy?: null|ChunkStrategy|ChunkStrategyShape,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   filesBucket?: string|null,
 *   indexName?: string|null,
 *   kmsKeyID?: string|null,
 *   metadata?: mixed,
 *   name?: string|null,
 *   region?: string|null,
 *   totalBytes?: int|null,
 *   totalObjects?: int|null,
 *   totalVectors?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   vectorBucket?: string|null,
 * }
 */
final class VaultGetResponse implements BaseModel
{
    /** @use SdkModel<VaultGetResponseShape> */
    use SdkModel;

    /**
     * Vault identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Document chunking strategy configuration.
     */
    #[Optional]
    public ?ChunkStrategy $chunkStrategy;

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
     * S3 bucket for document storage.
     */
    #[Optional]
    public ?string $filesBucket;

    /**
     * Search index name.
     */
    #[Optional]
    public ?string $indexName;

    /**
     * KMS key for encryption.
     */
    #[Optional('kmsKeyId')]
    public ?string $kmsKeyID;

    /**
     * Additional vault metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Vault name.
     */
    #[Optional]
    public ?string $name;

    /**
     * AWS region.
     */
    #[Optional]
    public ?string $region;

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

    /**
     * Number of vector embeddings.
     */
    #[Optional]
    public ?int $totalVectors;

    /**
     * Last update timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    /**
     * S3 bucket for vector embeddings.
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
     *
     * @param ChunkStrategy|ChunkStrategyShape|null $chunkStrategy
     */
    public static function with(
        ?string $id = null,
        ChunkStrategy|array|null $chunkStrategy = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $filesBucket = null,
        ?string $indexName = null,
        ?string $kmsKeyID = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $region = null,
        ?int $totalBytes = null,
        ?int $totalObjects = null,
        ?int $totalVectors = null,
        ?\DateTimeInterface $updatedAt = null,
        ?string $vectorBucket = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $chunkStrategy && $self['chunkStrategy'] = $chunkStrategy;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $filesBucket && $self['filesBucket'] = $filesBucket;
        null !== $indexName && $self['indexName'] = $indexName;
        null !== $kmsKeyID && $self['kmsKeyID'] = $kmsKeyID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $region && $self['region'] = $region;
        null !== $totalBytes && $self['totalBytes'] = $totalBytes;
        null !== $totalObjects && $self['totalObjects'] = $totalObjects;
        null !== $totalVectors && $self['totalVectors'] = $totalVectors;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $vectorBucket && $self['vectorBucket'] = $vectorBucket;

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
     * Document chunking strategy configuration.
     *
     * @param ChunkStrategy|ChunkStrategyShape $chunkStrategy
     */
    public function withChunkStrategy(ChunkStrategy|array $chunkStrategy): self
    {
        $self = clone $this;
        $self['chunkStrategy'] = $chunkStrategy;

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
     * S3 bucket for document storage.
     */
    public function withFilesBucket(string $filesBucket): self
    {
        $self = clone $this;
        $self['filesBucket'] = $filesBucket;

        return $self;
    }

    /**
     * Search index name.
     */
    public function withIndexName(string $indexName): self
    {
        $self = clone $this;
        $self['indexName'] = $indexName;

        return $self;
    }

    /**
     * KMS key for encryption.
     */
    public function withKmsKeyID(string $kmsKeyID): self
    {
        $self = clone $this;
        $self['kmsKeyID'] = $kmsKeyID;

        return $self;
    }

    /**
     * Additional vault metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

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
     * AWS region.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

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

    /**
     * Number of vector embeddings.
     */
    public function withTotalVectors(int $totalVectors): self
    {
        $self = clone $this;
        $self['totalVectors'] = $totalVectors;

        return $self;
    }

    /**
     * Last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * S3 bucket for vector embeddings.
     */
    public function withVectorBucket(?string $vectorBucket): self
    {
        $self = clone $this;
        $self['vectorBucket'] = $vectorBucket;

        return $self;
    }
}
