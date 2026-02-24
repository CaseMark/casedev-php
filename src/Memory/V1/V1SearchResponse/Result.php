<?php

declare(strict_types=1);

namespace CaseDev\Memory\V1\V1SearchResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Memory\V1\V1SearchResponse\Result\Tags;

/**
 * @phpstan-import-type TagsShape from \CaseDev\Memory\V1\V1SearchResponse\Result\Tags
 *
 * @phpstan-type ResultShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   memory?: string|null,
 *   metadata?: mixed,
 *   score?: float|null,
 *   tags?: null|Tags|TagsShape,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Memory ID.
     */
    #[Optional]
    public ?string $id;

    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * Memory content.
     */
    #[Optional]
    public ?string $memory;

    /**
     * Additional metadata.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Similarity score (0-1).
     */
    #[Optional]
    public ?float $score;

    /**
     * Tag values for this memory.
     */
    #[Optional]
    public ?Tags $tags;

    #[Optional('updated_at')]
    public ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Tags|TagsShape|null $tags
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $memory = null,
        mixed $metadata = null,
        ?float $score = null,
        Tags|array|null $tags = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $memory && $self['memory'] = $memory;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $score && $self['score'] = $score;
        null !== $tags && $self['tags'] = $tags;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Memory ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Memory content.
     */
    public function withMemory(string $memory): self
    {
        $self = clone $this;
        $self['memory'] = $memory;

        return $self;
    }

    /**
     * Additional metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Similarity score (0-1).
     */
    public function withScore(float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Tag values for this memory.
     *
     * @param Tags|TagsShape $tags
     */
    public function withTags(Tags|array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
