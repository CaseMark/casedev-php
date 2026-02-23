<?php

declare(strict_types=1);

namespace Router\Vault\Objects;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Vault\Objects\ObjectNewPresignedURLResponse\Metadata;

/**
 * @phpstan-import-type MetadataShape from \Router\Vault\Objects\ObjectNewPresignedURLResponse\Metadata
 *
 * @phpstan-type ObjectNewPresignedURLResponseShape = array{
 *   expiresAt?: \DateTimeInterface|null,
 *   expiresIn?: int|null,
 *   filename?: string|null,
 *   instructions?: mixed,
 *   metadata?: null|Metadata|MetadataShape,
 *   objectID?: string|null,
 *   operation?: string|null,
 *   presignedURL?: string|null,
 *   s3Key?: string|null,
 *   vaultID?: string|null,
 * }
 */
final class ObjectNewPresignedURLResponse implements BaseModel
{
    /** @use SdkModel<ObjectNewPresignedURLResponseShape> */
    use SdkModel;

    /**
     * URL expiration timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $expiresAt;

    /**
     * URL expiration time in seconds.
     */
    #[Optional]
    public ?int $expiresIn;

    /**
     * Original filename.
     */
    #[Optional]
    public ?string $filename;

    /**
     * Usage instructions and examples.
     */
    #[Optional]
    public mixed $instructions;

    #[Optional]
    public ?Metadata $metadata;

    /**
     * The object identifier.
     */
    #[Optional('objectId')]
    public ?string $objectID;

    /**
     * The operation type.
     */
    #[Optional]
    public ?string $operation;

    /**
     * The presigned URL for direct S3 access.
     */
    #[Optional('presignedUrl')]
    public ?string $presignedURL;

    /**
     * S3 object key.
     */
    #[Optional]
    public ?string $s3Key;

    /**
     * The vault identifier.
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
     *
     * @param Metadata|MetadataShape|null $metadata
     */
    public static function with(
        ?\DateTimeInterface $expiresAt = null,
        ?int $expiresIn = null,
        ?string $filename = null,
        mixed $instructions = null,
        Metadata|array|null $metadata = null,
        ?string $objectID = null,
        ?string $operation = null,
        ?string $presignedURL = null,
        ?string $s3Key = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $filename && $self['filename'] = $filename;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $operation && $self['operation'] = $operation;
        null !== $presignedURL && $self['presignedURL'] = $presignedURL;
        null !== $s3Key && $self['s3Key'] = $s3Key;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * URL expiration timestamp.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

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
     * Usage instructions and examples.
     */
    public function withInstructions(mixed $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * The object identifier.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * The operation type.
     */
    public function withOperation(string $operation): self
    {
        $self = clone $this;
        $self['operation'] = $operation;

        return $self;
    }

    /**
     * The presigned URL for direct S3 access.
     */
    public function withPresignedURL(string $presignedURL): self
    {
        $self = clone $this;
        $self['presignedURL'] = $presignedURL;

        return $self;
    }

    /**
     * S3 object key.
     */
    public function withS3Key(string $s3Key): self
    {
        $self = clone $this;
        $self['s3Key'] = $s3Key;

        return $self;
    }

    /**
     * The vault identifier.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
