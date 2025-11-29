<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Vault\VaultUploadResponse\Instructions;

/**
 * @phpstan-type VaultUploadResponseShape = array{
 *   auto_index?: bool|null,
 *   expiresIn?: float|null,
 *   instructions?: Instructions|null,
 *   next_step?: string|null,
 *   objectId?: string|null,
 *   s3Key?: string|null,
 *   uploadUrl?: string|null,
 * }
 */
final class VaultUploadResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<VaultUploadResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Whether the file will be automatically indexed.
     */
    #[Api(optional: true)]
    public ?bool $auto_index;

    /**
     * URL expiration time in seconds.
     */
    #[Api(optional: true)]
    public ?float $expiresIn;

    #[Api(optional: true)]
    public ?Instructions $instructions;

    /**
     * Next API endpoint to call for processing.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $next_step;

    /**
     * Unique identifier for the uploaded object.
     */
    #[Api(optional: true)]
    public ?string $objectId;

    /**
     * S3 object key for the file.
     */
    #[Api(optional: true)]
    public ?string $s3Key;

    /**
     * Presigned URL for uploading the file.
     */
    #[Api(optional: true)]
    public ?string $uploadUrl;

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
        ?bool $auto_index = null,
        ?float $expiresIn = null,
        ?Instructions $instructions = null,
        ?string $next_step = null,
        ?string $objectId = null,
        ?string $s3Key = null,
        ?string $uploadUrl = null,
    ): self {
        $obj = new self;

        null !== $auto_index && $obj->auto_index = $auto_index;
        null !== $expiresIn && $obj->expiresIn = $expiresIn;
        null !== $instructions && $obj->instructions = $instructions;
        null !== $next_step && $obj->next_step = $next_step;
        null !== $objectId && $obj->objectId = $objectId;
        null !== $s3Key && $obj->s3Key = $s3Key;
        null !== $uploadUrl && $obj->uploadUrl = $uploadUrl;

        return $obj;
    }

    /**
     * Whether the file will be automatically indexed.
     */
    public function withAutoIndex(bool $autoIndex): self
    {
        $obj = clone $this;
        $obj->auto_index = $autoIndex;

        return $obj;
    }

    /**
     * URL expiration time in seconds.
     */
    public function withExpiresIn(float $expiresIn): self
    {
        $obj = clone $this;
        $obj->expiresIn = $expiresIn;

        return $obj;
    }

    public function withInstructions(Instructions $instructions): self
    {
        $obj = clone $this;
        $obj->instructions = $instructions;

        return $obj;
    }

    /**
     * Next API endpoint to call for processing.
     */
    public function withNextStep(?string $nextStep): self
    {
        $obj = clone $this;
        $obj->next_step = $nextStep;

        return $obj;
    }

    /**
     * Unique identifier for the uploaded object.
     */
    public function withObjectID(string $objectID): self
    {
        $obj = clone $this;
        $obj->objectId = $objectID;

        return $obj;
    }

    /**
     * S3 object key for the file.
     */
    public function withS3Key(string $s3Key): self
    {
        $obj = clone $this;
        $obj->s3Key = $s3Key;

        return $obj;
    }

    /**
     * Presigned URL for uploading the file.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $obj = clone $this;
        $obj->uploadUrl = $uploadURL;

        return $obj;
    }
}
