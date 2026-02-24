<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultSearchResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SourceShape = array{
 *   id?: string|null,
 *   chunkCount?: int|null,
 *   createdAt?: \DateTimeInterface|null,
 *   filename?: string|null,
 *   ingestionCompletedAt?: \DateTimeInterface|null,
 *   pageCount?: int|null,
 *   textLength?: int|null,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?int $chunkCount;

    #[Optional]
    public ?\DateTimeInterface $createdAt;

    #[Optional]
    public ?string $filename;

    #[Optional]
    public ?\DateTimeInterface $ingestionCompletedAt;

    #[Optional]
    public ?int $pageCount;

    #[Optional]
    public ?int $textLength;

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
        ?int $chunkCount = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $filename = null,
        ?\DateTimeInterface $ingestionCompletedAt = null,
        ?int $pageCount = null,
        ?int $textLength = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $filename && $self['filename'] = $filename;
        null !== $ingestionCompletedAt && $self['ingestionCompletedAt'] = $ingestionCompletedAt;
        null !== $pageCount && $self['pageCount'] = $pageCount;
        null !== $textLength && $self['textLength'] = $textLength;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withChunkCount(int $chunkCount): self
    {
        $self = clone $this;
        $self['chunkCount'] = $chunkCount;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    public function withIngestionCompletedAt(
        \DateTimeInterface $ingestionCompletedAt
    ): self {
        $self = clone $this;
        $self['ingestionCompletedAt'] = $ingestionCompletedAt;

        return $self;
    }

    public function withPageCount(int $pageCount): self
    {
        $self = clone $this;
        $self['pageCount'] = $pageCount;

        return $self;
    }

    public function withTextLength(int $textLength): self
    {
        $self = clone $this;
        $self['textLength'] = $textLength;

        return $self;
    }
}
