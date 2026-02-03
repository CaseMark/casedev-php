<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ObjectUpdateResponseShape = array{
 *   id?: string|null,
 *   contentType?: string|null,
 *   filename?: string|null,
 *   ingestionStatus?: string|null,
 *   metadata?: mixed,
 *   path?: string|null,
 *   sizeBytes?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   vaultID?: string|null,
 * }
 */
final class ObjectUpdateResponse implements BaseModel
{
    /** @use SdkModel<ObjectUpdateResponseShape> */
    use SdkModel;

    /**
     * Object ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * MIME type.
     */
    #[Optional]
    public ?string $contentType;

    /**
     * Updated filename.
     */
    #[Optional]
    public ?string $filename;

    /**
     * Processing status.
     */
    #[Optional]
    public ?string $ingestionStatus;

    /**
     * Full metadata object.
     */
    #[Optional]
    public mixed $metadata;

    /**
     * Folder path for hierarchy preservation.
     */
    #[Optional(nullable: true)]
    public ?string $path;

    /**
     * File size in bytes.
     */
    #[Optional]
    public ?int $sizeBytes;

    /**
     * Last update timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    /**
     * Vault ID.
     */
    #[Optional('vaultId')]
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
        ?string $id = null,
        ?string $contentType = null,
        ?string $filename = null,
        ?string $ingestionStatus = null,
        mixed $metadata = null,
        ?string $path = null,
        ?int $sizeBytes = null,
        ?\DateTimeInterface $updatedAt = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $contentType && $self['contentType'] = $contentType;
        null !== $filename && $self['filename'] = $filename;
        null !== $ingestionStatus && $self['ingestionStatus'] = $ingestionStatus;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Object ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * MIME type.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Updated filename.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Processing status.
     */
    public function withIngestionStatus(string $ingestionStatus): self
    {
        $self = clone $this;
        $self['ingestionStatus'] = $ingestionStatus;

        return $self;
    }

    /**
     * Full metadata object.
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Folder path for hierarchy preservation.
     */
    public function withPath(?string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * File size in bytes.
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Vault ID.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
