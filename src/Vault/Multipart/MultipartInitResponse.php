<?php

declare(strict_types=1);

namespace Casedev\Vault\Multipart;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MultipartInitResponseShape = array{
 *   nextStep?: string|null,
 *   objectID?: string|null,
 *   partCount?: int|null,
 *   partSizeBytes?: int|null,
 *   s3Key?: string|null,
 *   uploadID?: string|null,
 * }
 */
final class MultipartInitResponse implements BaseModel
{
    /** @use SdkModel<MultipartInitResponseShape> */
    use SdkModel;

    #[Optional('next_step')]
    public ?string $nextStep;

    #[Optional('objectId')]
    public ?string $objectID;

    #[Optional]
    public ?int $partCount;

    #[Optional]
    public ?int $partSizeBytes;

    #[Optional]
    public ?string $s3Key;

    #[Optional('uploadId')]
    public ?string $uploadID;

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
        ?string $nextStep = null,
        ?string $objectID = null,
        ?int $partCount = null,
        ?int $partSizeBytes = null,
        ?string $s3Key = null,
        ?string $uploadID = null,
    ): self {
        $self = new self;

        null !== $nextStep && $self['nextStep'] = $nextStep;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $partCount && $self['partCount'] = $partCount;
        null !== $partSizeBytes && $self['partSizeBytes'] = $partSizeBytes;
        null !== $s3Key && $self['s3Key'] = $s3Key;
        null !== $uploadID && $self['uploadID'] = $uploadID;

        return $self;
    }

    public function withNextStep(string $nextStep): self
    {
        $self = clone $this;
        $self['nextStep'] = $nextStep;

        return $self;
    }

    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    public function withPartCount(int $partCount): self
    {
        $self = clone $this;
        $self['partCount'] = $partCount;

        return $self;
    }

    public function withPartSizeBytes(int $partSizeBytes): self
    {
        $self = clone $this;
        $self['partSizeBytes'] = $partSizeBytes;

        return $self;
    }

    public function withS3Key(string $s3Key): self
    {
        $self = clone $this;
        $self['s3Key'] = $s3Key;

        return $self;
    }

    public function withUploadID(string $uploadID): self
    {
        $self = clone $this;
        $self['uploadID'] = $uploadID;

        return $self;
    }
}
