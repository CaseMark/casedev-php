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
 *   expiresIn?: float|null,
 *   instructions?: null|Instructions|InstructionsShape,
 *   nextStep?: string|null,
 *   objectID?: string|null,
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
     * @param InstructionsShape $instructions
     */
    public static function with(
        ?bool $autoIndex = null,
        ?float $expiresIn = null,
        Instructions|array|null $instructions = null,
        ?string $nextStep = null,
        ?string $objectID = null,
        ?string $s3Key = null,
        ?string $uploadURL = null,
    ): self {
        $self = new self;

        null !== $autoIndex && $self['autoIndex'] = $autoIndex;
        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $nextStep && $self['nextStep'] = $nextStep;
        null !== $objectID && $self['objectID'] = $objectID;
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
     * URL expiration time in seconds.
     */
    public function withExpiresIn(float $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * @param InstructionsShape $instructions
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
