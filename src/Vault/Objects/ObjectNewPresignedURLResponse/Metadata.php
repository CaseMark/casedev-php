<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectNewPresignedURLResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetadataShape = array{
 *   bucket?: string|null,
 *   contentType?: string|null,
 *   region?: string|null,
 *   sizeBytes?: int|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    #[Optional]
    public ?string $bucket;

    #[Optional]
    public ?string $contentType;

    #[Optional]
    public ?string $region;

    #[Optional]
    public ?int $sizeBytes;

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
        ?string $bucket = null,
        ?string $contentType = null,
        ?string $region = null,
        ?int $sizeBytes = null,
    ): self {
        $self = new self;

        null !== $bucket && $self['bucket'] = $bucket;
        null !== $contentType && $self['contentType'] = $contentType;
        null !== $region && $self['region'] = $region;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

        return $self;
    }

    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }
}
