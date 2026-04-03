<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory\MemoryListResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetaShape = array{
 *   chars?: int|null,
 *   count?: int|null,
 *   maxChars?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Meta implements BaseModel
{
    /** @use SdkModel<MetaShape> */
    use SdkModel;

    #[Optional]
    public ?int $chars;

    #[Optional]
    public ?int $count;

    #[Optional('max_chars')]
    public ?int $maxChars;

    #[Optional('updated_at', nullable: true)]
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
        ?int $chars = null,
        ?int $count = null,
        ?int $maxChars = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $chars && $self['chars'] = $chars;
        null !== $count && $self['count'] = $count;
        null !== $maxChars && $self['maxChars'] = $maxChars;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withChars(int $chars): self
    {
        $self = clone $this;
        $self['chars'] = $chars;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    public function withMaxChars(int $maxChars): self
    {
        $self = clone $this;
        $self['maxChars'] = $maxChars;

        return $self;
    }

    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
