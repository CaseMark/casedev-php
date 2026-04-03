<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory\MemoryListResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EntryShape = array{
 *   id?: string|null,
 *   content?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   createdBy?: string|null,
 *   source?: string|null,
 *   tags?: list<string>|null,
 *   type?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Entry implements BaseModel
{
    /** @use SdkModel<EntryShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $content;

    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    #[Optional('created_by', nullable: true)]
    public ?string $createdBy;

    #[Optional(nullable: true)]
    public ?string $source;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    #[Optional]
    public ?string $type;

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
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $id = null,
        ?string $content = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $createdBy = null,
        ?string $source = null,
        ?array $tags = null,
        ?string $type = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $content && $self['content'] = $content;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $createdBy && $self['createdBy'] = $createdBy;
        null !== $source && $self['source'] = $source;
        null !== $tags && $self['tags'] = $tags;
        null !== $type && $self['type'] = $type;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCreatedBy(?string $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    public function withSource(?string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
