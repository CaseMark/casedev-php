<?php

declare(strict_types=1);

namespace Router\Vault\Objects\ObjectDeleteResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeletedObjectShape = array{
 *   id?: string|null,
 *   filename?: string|null,
 *   sizeBytes?: int|null,
 *   vectorsDeleted?: int|null,
 * }
 */
final class DeletedObject implements BaseModel
{
    /** @use SdkModel<DeletedObjectShape> */
    use SdkModel;

    /**
     * Deleted object ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Original filename.
     */
    #[Optional]
    public ?string $filename;

    /**
     * Size of deleted file in bytes.
     */
    #[Optional]
    public ?int $sizeBytes;

    /**
     * Number of vectors deleted.
     */
    #[Optional]
    public ?int $vectorsDeleted;

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
        ?string $filename = null,
        ?int $sizeBytes = null,
        ?int $vectorsDeleted = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $filename && $self['filename'] = $filename;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;
        null !== $vectorsDeleted && $self['vectorsDeleted'] = $vectorsDeleted;

        return $self;
    }

    /**
     * Deleted object ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Original filename.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Size of deleted file in bytes.
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    /**
     * Number of vectors deleted.
     */
    public function withVectorsDeleted(int $vectorsDeleted): self
    {
        $self = clone $this;
        $self['vectorsDeleted'] = $vectorsDeleted;

        return $self;
    }
}
