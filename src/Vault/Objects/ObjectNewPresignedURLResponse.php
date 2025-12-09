<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse\Metadata;

/**
 * @phpstan-type ObjectNewPresignedURLResponseShape = array{
 *   expiresAt?: \DateTimeInterface|null,
 *   expiresIn?: int|null,
 *   filename?: string|null,
 *   instructions?: mixed,
 *   metadata?: Metadata|null,
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
     * @param Metadata|array{
     *   bucket?: string|null,
     *   contentType?: string|null,
     *   region?: string|null,
     *   sizeBytes?: int|null,
     * } $metadata
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
        $obj = new self;

        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $expiresIn && $obj['expiresIn'] = $expiresIn;
        null !== $filename && $obj['filename'] = $filename;
        null !== $instructions && $obj['instructions'] = $instructions;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $objectID && $obj['objectID'] = $objectID;
        null !== $operation && $obj['operation'] = $operation;
        null !== $presignedURL && $obj['presignedURL'] = $presignedURL;
        null !== $s3Key && $obj['s3Key'] = $s3Key;
        null !== $vaultID && $obj['vaultID'] = $vaultID;

        return $obj;
    }

    /**
     * URL expiration timestamp.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $obj = clone $this;
        $obj['expiresIn'] = $expiresIn;

        return $obj;
    }

    /**
     * Original filename.
     */
    public function withFilename(string $filename): self
    {
        $obj = clone $this;
        $obj['filename'] = $filename;

        return $obj;
    }

    /**
     * Usage instructions and examples.
     */
    public function withInstructions(mixed $instructions): self
    {
        $obj = clone $this;
        $obj['instructions'] = $instructions;

        return $obj;
    }

    /**
     * @param Metadata|array{
     *   bucket?: string|null,
     *   contentType?: string|null,
     *   region?: string|null,
     *   sizeBytes?: int|null,
     * } $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * The object identifier.
     */
    public function withObjectID(string $objectID): self
    {
        $obj = clone $this;
        $obj['objectID'] = $objectID;

        return $obj;
    }

    /**
     * The operation type.
     */
    public function withOperation(string $operation): self
    {
        $obj = clone $this;
        $obj['operation'] = $operation;

        return $obj;
    }

    /**
     * The presigned URL for direct S3 access.
     */
    public function withPresignedURL(string $presignedURL): self
    {
        $obj = clone $this;
        $obj['presignedURL'] = $presignedURL;

        return $obj;
    }

    /**
     * S3 object key.
     */
    public function withS3Key(string $s3Key): self
    {
        $obj = clone $this;
        $obj['s3Key'] = $s3Key;

        return $obj;
    }

    /**
     * The vault identifier.
     */
    public function withVaultID(string $vaultID): self
    {
        $obj = clone $this;
        $obj['vaultID'] = $vaultID;

        return $obj;
    }
}
