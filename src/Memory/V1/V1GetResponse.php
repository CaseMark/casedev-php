<?php

declare(strict_types=1);

namespace Router\Memory\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1GetResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   memory?: string|null,
 *   metadata?: mixed,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class V1GetResponse implements BaseModel
{
    /** @use SdkModel<V1GetResponseShape> */
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
     * Memory metadata.
     */
    #[Optional]
    public mixed $metadata;

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
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $memory = null,
        mixed $metadata = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $memory && $self['memory'] = $memory;
        null !== $metadata && $self['metadata'] = $metadata;
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
     * Memory metadata.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
