<?php

declare(strict_types=1);

namespace CaseDev\Vault;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\VaultGetResponse\ChunkStrategy;

/**
 * @phpstan-import-type ChunkStrategyShape from \CaseDev\Vault\VaultGetResponse\ChunkStrategy
 *
 * @phpstan-type VaultGetResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   filesBucket: string,
 *   name: string,
 *   region: string,
 *   chunkStrategy?: null|ChunkStrategy|ChunkStrategyShape,
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   indexName?: string|null,
 *   kmsKeyID?: string|null,
 *   metadata?: mixed,
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
    #[Required]
    public string $id;

    /**
     * Vault creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * S3 bucket for document storage.
     */
    #[Required]
    public string $filesBucket;

    /**
     * Vault name.
     */
    #[Required]
    public string $name;

    /**
     * AWS region.
     */
    #[Required]
    public string $region;

    /**
     * Document chunking strategy configuration.
     */
    #[Optional]
    public ?ChunkStrategy $chunkStrategy;

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

    /**
     * `new VaultGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultGetResponse::with(
     *   id: ..., createdAt: ..., filesBucket: ..., name: ..., region: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultGetResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withFilesBucket(...)
     *   ->withName(...)
     *   ->withRegion(...)
     * ```
     */
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
        string $id,
        \DateTimeInterface $createdAt,
        string $filesBucket,
        string $name,
        string $region,
        ChunkStrategy|array|null $chunkStrategy = null,
        ?string $description = null,
        ?bool $enableGraph = null,
        ?string $indexName = null,
        ?string $kmsKeyID = null,
        mixed $metadata = null,
        ?int $totalBytes = null,
        ?int $totalObjects = null,
        ?int $totalVectors = null,
        ?\DateTimeInterface $updatedAt = null,
        ?string $vectorBucket = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['filesBucket'] = $filesBucket;
        $self['name'] = $name;
        $self['region'] = $region;

        null !== $chunkStrategy && $self['chunkStrategy'] = $chunkStrategy;
        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $indexName && $self['indexName'] = $indexName;
        null !== $kmsKeyID && $self['kmsKeyID'] = $kmsKeyID;
        null !== $metadata && $self['metadata'] = $metadata;
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
     * Vault creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
