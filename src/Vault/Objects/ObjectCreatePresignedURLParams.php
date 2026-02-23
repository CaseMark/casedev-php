<?php

declare(strict_types=1);

namespace Router\Vault\Objects;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Vault\Objects\ObjectCreatePresignedURLParams\Operation;

/**
 * Generate presigned URLs for direct S3 operations (GET, PUT, DELETE, HEAD) on vault objects. This allows secure, time-limited access to files without proxying through the API. Essential for large document uploads/downloads in legal workflows.
 *
 * @see Router\Services\Vault\ObjectsService::createPresignedURL()
 *
 * @phpstan-type ObjectCreatePresignedURLParamsShape = array{
 *   id: string,
 *   contentType?: string|null,
 *   expiresIn?: int|null,
 *   operation?: null|Operation|value-of<Operation>,
 *   sizeBytes?: int|null,
 * }
 */
final class ObjectCreatePresignedURLParams implements BaseModel
{
    /** @use SdkModel<ObjectCreatePresignedURLParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Content type for PUT operations (optional, defaults to object's content type).
     */
    #[Optional]
    public ?string $contentType;

    /**
     * URL expiration time in seconds (1 minute to 7 days).
     */
    #[Optional]
    public ?int $expiresIn;

    /**
     * The S3 operation to generate URL for.
     *
     * @var value-of<Operation>|null $operation
     */
    #[Optional(enum: Operation::class)]
    public ?string $operation;

    /**
     * File size in bytes (optional, max 5GB for single PUT uploads). When provided for PUT operations, enforces exact file size at S3 level.
     */
    #[Optional]
    public ?int $sizeBytes;

    /**
     * `new ObjectCreatePresignedURLParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectCreatePresignedURLParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectCreatePresignedURLParams)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Operation|value-of<Operation>|null $operation
     */
    public static function with(
        string $id,
        ?string $contentType = null,
        ?int $expiresIn = null,
        Operation|string|null $operation = null,
        ?int $sizeBytes = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $expiresIn && $self['expiresIn'] = $expiresIn;
        null !== $operation && $self['operation'] = $operation;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Content type for PUT operations (optional, defaults to object's content type).
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * URL expiration time in seconds (1 minute to 7 days).
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * The S3 operation to generate URL for.
     *
     * @param Operation|value-of<Operation> $operation
     */
    public function withOperation(Operation|string $operation): self
    {
        $self = clone $this;
        $self['operation'] = $operation;

        return $self;
    }

    /**
     * File size in bytes (optional, max 5GB for single PUT uploads). When provided for PUT operations, enforces exact file size at S3 level.
     */
    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }
}
