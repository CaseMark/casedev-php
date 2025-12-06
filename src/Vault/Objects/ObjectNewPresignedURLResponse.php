<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Vault\Objects\ObjectNewPresignedURLResponse\Metadata;

/**
 * @phpstan-type ObjectNewPresignedURLResponseShape = array{
 *   expiresAt?: \DateTimeInterface|null,
 *   expiresIn?: int|null,
 *   filename?: string|null,
 *   instructions?: mixed,
 *   metadata?: Metadata|null,
 *   objectId?: string|null,
 *   operation?: string|null,
 *   presignedUrl?: string|null,
 *   s3Key?: string|null,
 *   vaultId?: string|null,
 * }
 */
final class ObjectNewPresignedURLResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ObjectNewPresignedURLResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * URL expiration timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * URL expiration time in seconds.
     */
    #[Api(optional: true)]
    public ?int $expiresIn;

    /**
     * Original filename.
     */
    #[Api(optional: true)]
    public ?string $filename;

    /**
     * Usage instructions and examples.
     */
    #[Api(optional: true)]
    public mixed $instructions;

    #[Api(optional: true)]
    public ?Metadata $metadata;

    /**
     * The object identifier.
     */
    #[Api(optional: true)]
    public ?string $objectId;

    /**
     * The operation type.
     */
    #[Api(optional: true)]
    public ?string $operation;

    /**
     * The presigned URL for direct S3 access.
     */
    #[Api(optional: true)]
    public ?string $presignedUrl;

    /**
     * S3 object key.
     */
    #[Api(optional: true)]
    public ?string $s3Key;

    /**
     * The vault identifier.
     */
    #[Api(optional: true)]
    public ?string $vaultId;

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
        ?string $objectId = null,
        ?string $operation = null,
        ?string $presignedUrl = null,
        ?string $s3Key = null,
        ?string $vaultId = null,
    ): self {
        $obj = new self;

        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $expiresIn && $obj['expiresIn'] = $expiresIn;
        null !== $filename && $obj['filename'] = $filename;
        null !== $instructions && $obj['instructions'] = $instructions;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $objectId && $obj['objectId'] = $objectId;
        null !== $operation && $obj['operation'] = $operation;
        null !== $presignedUrl && $obj['presignedUrl'] = $presignedUrl;
        null !== $s3Key && $obj['s3Key'] = $s3Key;
        null !== $vaultId && $obj['vaultId'] = $vaultId;

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
        $obj['objectId'] = $objectID;

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
        $obj['presignedUrl'] = $presignedURL;

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
        $obj['vaultId'] = $vaultID;

        return $obj;
    }
}
