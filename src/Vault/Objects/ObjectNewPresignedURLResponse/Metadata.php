<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects\ObjectNewPresignedURLResponse;

use Casedev\Core\Attributes\Api;
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

    #[Api(optional: true)]
    public ?string $bucket;

    #[Api(optional: true)]
    public ?string $contentType;

    #[Api(optional: true)]
    public ?string $region;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $bucket && $obj->bucket = $bucket;
        null !== $contentType && $obj->contentType = $contentType;
        null !== $region && $obj->region = $region;
        null !== $sizeBytes && $obj->sizeBytes = $sizeBytes;

        return $obj;
    }

    public function withBucket(string $bucket): self
    {
        $obj = clone $this;
        $obj->bucket = $bucket;

        return $obj;
    }

    public function withContentType(string $contentType): self
    {
        $obj = clone $this;
        $obj->contentType = $contentType;

        return $obj;
    }

    public function withRegion(string $region): self
    {
        $obj = clone $this;
        $obj->region = $region;

        return $obj;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $obj = clone $this;
        $obj->sizeBytes = $sizeBytes;

        return $obj;
    }
}
