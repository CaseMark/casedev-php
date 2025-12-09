<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultUploadResponse\Instructions;

/**
 * @phpstan-type VaultUploadResponseShape = array{
 *   autoIndex?: bool|null,
 *   expiresIn?: float|null,
 *   instructions?: Instructions|null,
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
     * @param Instructions|array{
     *   headers?: mixed, method?: string|null, note?: string|null
     * } $instructions
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
        $obj = new self;

        null !== $autoIndex && $obj['autoIndex'] = $autoIndex;
        null !== $expiresIn && $obj['expiresIn'] = $expiresIn;
        null !== $instructions && $obj['instructions'] = $instructions;
        null !== $nextStep && $obj['nextStep'] = $nextStep;
        null !== $objectID && $obj['objectID'] = $objectID;
        null !== $s3Key && $obj['s3Key'] = $s3Key;
        null !== $uploadURL && $obj['uploadURL'] = $uploadURL;

        return $obj;
    }

    /**
     * Whether the file will be automatically indexed.
     */
    public function withAutoIndex(bool $autoIndex): self
    {
        $obj = clone $this;
        $obj['autoIndex'] = $autoIndex;

        return $obj;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(float $expiresIn): self
    {
        $obj = clone $this;
        $obj['expiresIn'] = $expiresIn;

        return $obj;
    }

    /**
     * @param Instructions|array{
     *   headers?: mixed, method?: string|null, note?: string|null
     * } $instructions
     */
    public function withInstructions(Instructions|array $instructions): self
    {
        $obj = clone $this;
        $obj['instructions'] = $instructions;

        return $obj;
    }

    /**
     * Next API endpoint to call for processing.
     */
    public function withNextStep(?string $nextStep): self
    {
        $obj = clone $this;
        $obj['nextStep'] = $nextStep;

        return $obj;
    }

    /**
     * Unique identifier for the uploaded object.
     */
    public function withObjectID(string $objectID): self
    {
        $obj = clone $this;
        $obj['objectID'] = $objectID;

        return $obj;
    }

    /**
     * S3 object key for the file.
     */
    public function withS3Key(string $s3Key): self
    {
        $obj = clone $this;
        $obj['s3Key'] = $s3Key;

        return $obj;
    }

    /**
     * Presigned URL for uploading the file.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $obj = clone $this;
        $obj['uploadURL'] = $uploadURL;

        return $obj;
    }
}
