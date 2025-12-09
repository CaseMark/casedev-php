<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VaultNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
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
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Vault creation timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Vault description.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * S3 bucket name for document storage.
     */
    #[Api(optional: true)]
    public ?string $filesBucket;

    /**
     * Vector search index name.
     */
    #[Api(optional: true)]
    public ?string $indexName;

    /**
     * Vault display name.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * AWS region for storage.
     */
    #[Api(optional: true)]
    public ?string $region;

    /**
     * S3 bucket name for vector embeddings.
     */
    #[Api(optional: true)]
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
        ?string $filesBucket = null,
        ?string $indexName = null,
        ?string $name = null,
        ?string $region = null,
        ?string $vectorBucket = null,
    ): self {
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $description && $obj['description'] = $description;
        null !== $filesBucket && $obj['filesBucket'] = $filesBucket;
        null !== $indexName && $obj['indexName'] = $indexName;
        null !== $name && $obj['name'] = $name;
        null !== $region && $obj['region'] = $region;
        null !== $vectorBucket && $obj['vectorBucket'] = $vectorBucket;

        return $obj;
    }

    /**
     * Unique vault identifier.
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
     * S3 bucket name for document storage.
     */
    public function withFilesBucket(string $filesBucket): self
    {
        $obj = clone $this;
        $obj['filesBucket'] = $filesBucket;

        return $obj;
    }

    /**
     * Vector search index name.
     */
    public function withIndexName(string $indexName): self
    {
        $obj = clone $this;
        $obj['indexName'] = $indexName;

        return $obj;
    }

    /**
     * Vault display name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * AWS region for storage.
     */
    public function withRegion(string $region): self
    {
        $obj = clone $this;
        $obj['region'] = $region;

        return $obj;
    }

    /**
     * S3 bucket name for vector embeddings.
     */
    public function withVectorBucket(string $vectorBucket): self
    {
        $obj = clone $this;
        $obj['vectorBucket'] = $vectorBucket;

        return $obj;
    }
}
