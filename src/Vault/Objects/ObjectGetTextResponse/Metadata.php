<?php

declare(strict_types=1);

namespace Router\Vault\Objects\ObjectGetTextResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetadataShape = array{
 *   chunkCount: int,
 *   filename: string,
 *   length: int,
 *   objectID: string,
 *   vaultID: string,
 *   ingestionCompletedAt?: \DateTimeInterface|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Number of text chunks the document was split into.
     */
    #[Required('chunk_count')]
    public int $chunkCount;

    /**
     * Original filename of the document.
     */
    #[Required]
    public string $filename;

    /**
     * Total character count of the extracted text.
     */
    #[Required]
    public int $length;

    /**
     * The object ID.
     */
    #[Required('object_id')]
    public string $objectID;

    /**
     * The vault ID.
     */
    #[Required('vault_id')]
    public string $vaultID;

    /**
     * When the document processing completed.
     */
    #[Optional('ingestion_completed_at')]
    public ?\DateTimeInterface $ingestionCompletedAt;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   chunkCount: ..., filename: ..., length: ..., objectID: ..., vaultID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metadata)
     *   ->withChunkCount(...)
     *   ->withFilename(...)
     *   ->withLength(...)
     *   ->withObjectID(...)
     *   ->withVaultID(...)
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
     */
    public static function with(
        int $chunkCount,
        string $filename,
        int $length,
        string $objectID,
        string $vaultID,
        ?\DateTimeInterface $ingestionCompletedAt = null,
    ): self {
        $self = new self;

        $self['chunkCount'] = $chunkCount;
        $self['filename'] = $filename;
        $self['length'] = $length;
        $self['objectID'] = $objectID;
        $self['vaultID'] = $vaultID;

        null !== $ingestionCompletedAt && $self['ingestionCompletedAt'] = $ingestionCompletedAt;

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
}
