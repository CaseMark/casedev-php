<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets\SecretGetGroupResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type KeyShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   key?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Key implements BaseModel
{
    /** @use SdkModel<KeyShape> */
    use SdkModel;

    /**
     * When the secret was created.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Name of the secret key.
     */
    #[Optional]
    public ?string $key;

    /**
     * When the secret was last updated.
     */
    #[Optional]
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
        ?\DateTimeInterface $createdAt = null,
        ?string $key = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $key && $self['key'] = $key;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * When the secret was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Name of the secret key.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * When the secret was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
