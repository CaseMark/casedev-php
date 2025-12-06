<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultSearchResponse;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

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

    #[Api(optional: true)]
    public ?string $id;

    #[Api(optional: true)]
    public ?int $chunkCount;

    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    #[Api(optional: true)]
    public ?string $filename;

    #[Api(optional: true)]
    public ?\DateTimeInterface $ingestionCompletedAt;

    #[Api(optional: true)]
    public ?int $pageCount;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $chunkCount && $obj['chunkCount'] = $chunkCount;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $filename && $obj['filename'] = $filename;
        null !== $ingestionCompletedAt && $obj['ingestionCompletedAt'] = $ingestionCompletedAt;
        null !== $pageCount && $obj['pageCount'] = $pageCount;
        null !== $textLength && $obj['textLength'] = $textLength;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withChunkCount(int $chunkCount): self
    {
        $obj = clone $this;
        $obj['chunkCount'] = $chunkCount;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    public function withFilename(string $filename): self
    {
        $obj = clone $this;
        $obj['filename'] = $filename;

        return $obj;
    }

    public function withIngestionCompletedAt(
        \DateTimeInterface $ingestionCompletedAt
    ): self {
        $obj = clone $this;
        $obj['ingestionCompletedAt'] = $ingestionCompletedAt;

        return $obj;
    }

    public function withPageCount(int $pageCount): self
    {
        $obj = clone $this;
        $obj['pageCount'] = $pageCount;

        return $obj;
    }

    public function withTextLength(int $textLength): self
    {
        $obj = clone $this;
        $obj['textLength'] = $textLength;

        return $obj;
    }
}
