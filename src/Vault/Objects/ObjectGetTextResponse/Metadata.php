<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectGetTextResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetadataShape = array{
 *   chunkCount?: int|null,
 *   filename?: string|null,
 *   ingestionCompletedAt?: \DateTimeInterface|null,
 *   length?: int|null,
 *   objectID?: string|null,
 *   vaultID?: string|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Number of text chunks the document was split into.
     */
    #[Optional('chunk_count')]
    public ?int $chunkCount;

    /**
     * Original filename of the document.
     */
    #[Optional]
    public ?string $filename;

    /**
     * When the document processing completed.
     */
    #[Optional('ingestion_completed_at')]
    public ?\DateTimeInterface $ingestionCompletedAt;

    /**
     * Total character count of the extracted text.
     */
    #[Optional]
    public ?int $length;

    /**
     * The object ID.
     */
    #[Optional('object_id')]
    public ?string $objectID;

    /**
     * The vault ID.
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

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
        ?int $chunkCount = null,
        ?string $filename = null,
        ?\DateTimeInterface $ingestionCompletedAt = null,
        ?int $length = null,
        ?string $objectID = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $chunkCount && $self['chunkCount'] = $chunkCount;
        null !== $filename && $self['filename'] = $filename;
        null !== $ingestionCompletedAt && $self['ingestionCompletedAt'] = $ingestionCompletedAt;
        null !== $length && $self['length'] = $length;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Number of text chunks the document was split into.
     */
    public function withChunkCount(int $chunkCount): self
    {
        $self = clone $this;
        $self['chunkCount'] = $chunkCount;

        return $self;
    }

    /**
     * Original filename of the document.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * When the document processing completed.
     */
    public function withIngestionCompletedAt(
        \DateTimeInterface $ingestionCompletedAt
    ): self {
        $self = clone $this;
        $self['ingestionCompletedAt'] = $ingestionCompletedAt;

        return $self;
    }

    /**
     * Total character count of the extracted text.
     */
    public function withLength(int $length): self
    {
        $self = clone $this;
        $self['length'] = $length;

        return $self;
    }

    /**
     * The object ID.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * The vault ID.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
