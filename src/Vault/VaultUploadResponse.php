<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultUploadResponse\Instructions;

/**
 * @phpstan-import-type InstructionsShape from \Casedev\Vault\VaultUploadResponse\Instructions
 *
 * @phpstan-type VaultUploadResponseShape = array{
 *   autoIndex?: bool|null,
 *   enableIndexing?: bool|null,
 *   expiresIn?: float|null,
 *   instructions?: null|Instructions|InstructionsShape,
 *   nextStep?: string|null,
 *   objectID?: string|null,
 *   path?: string|null,
 *   s3Key?: string|null,
 *   uploadURL?: string|null,
 * }
 */
final class VaultUploadResponse implements BaseModel
{
    /** @use SdkModel<VaultUploadResponseShape> */
    use SdkModel;

    /**
     * Whether the file will be automatically indexed.
     */
    #[Optional('auto_index')]
    public ?bool $autoIndex;

    /**
     * Whether the vault supports indexing. False for storage-only vaults.
     */
    #[Optional]
    public ?bool $enableIndexing;

    /**
     * URL expiration time in seconds.
     */
    #[Optional]
    public ?float $expiresIn;

    #[Optional]
    public ?Instructions $instructions;

    /**
     * Next API endpoint to call for processing.
     */
    #[Optional('next_step', nullable: true)]
    public ?string $nextStep;

    /**
     * Unique identifier for the uploaded object.
     */
    #[Optional('objectId')]
    public ?string $objectID;

    /**
     * Folder path for hierarchy if provided.
     */
    #[Optional(nullable: true)]
    public ?string $path;

    /**
     * S3 object key for the file.
     */
    #[Optional]
    public ?string $s3Key;

    /**
     * Presigned URL for uploading the file.
     */
    #[Optional('uploadUrl')]
    public ?string $uploadURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Instructions|InstructionsShape|null $instructions
     */
    public static function with(
        ?bool $autoIndex = null,
        ?bool $enableIndexing = null,
        ?float $expiresIn = null,
        Instructions|array|null $instructions = null,
        ?string $nextStep = null,
        ?string $objectID = null,
        ?string $path = null,
        ?string $s3Key = null,
        ?string $uploadURL = null,
    ): self {
        $self = new self;

        null !== $autoIndex && $self['autoIndex'] = $autoIndex;
        null !== $enableIndexing && $self['enableIndexing'] = $enableIndexing;
        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $nextStep && $self['nextStep'] = $nextStep;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $path && $self['path'] = $path;
        null !== $s3Key && $self['s3Key'] = $s3Key;
        null !== $uploadURL && $self['uploadURL'] = $uploadURL;

        return $self;
    }

    /**
     * Whether the file will be automatically indexed.
     */
    public function withAutoIndex(bool $autoIndex): self
    {
        $self = clone $this;
        $self['autoIndex'] = $autoIndex;

        return $self;
    }

    /**
     * Whether the vault supports indexing. False for storage-only vaults.
     */
    public function withEnableIndexing(bool $enableIndexing): self
    {
        $self = clone $this;
        $self['enableIndexing'] = $enableIndexing;

        return $self;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(float $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * @param Instructions|InstructionsShape $instructions
     */
    public function withInstructions(Instructions|array $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Next API endpoint to call for processing.
     */
    public function withNextStep(?string $nextStep): self
    {
        $self = clone $this;
        $self['nextStep'] = $nextStep;

        return $self;
    }

    /**
     * Unique identifier for the uploaded object.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Folder path for hierarchy if provided.
     */
    public function withPath(?string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * S3 object key for the file.
     */
    public function withS3Key(string $s3Key): self
    {
        $self = clone $this;
        $self['s3Key'] = $s3Key;

        return $self;
    }

    /**
     * Presigned URL for uploading the file.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $self = clone $this;
        $self['uploadURL'] = $uploadURL;

        return $self;
    }
}
