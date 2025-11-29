<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectCreatePresignedURLParams\Operation;

/**
 * Generate presigned URLs for direct S3 operations (GET, PUT, DELETE, HEAD) on vault objects. This allows secure, time-limited access to files without proxying through the API. Essential for large document uploads/downloads in legal workflows.
 *
 * @see Casedev\Services\Vault\ObjectsService::createPresignedURL()
 *
 * @phpstan-type ObjectCreatePresignedURLParamsShape = array{
 *   id: string,
 *   contentType?: string,
 *   expiresIn?: int,
 *   operation?: Operation|value-of<Operation>,
 * }
 */
final class ObjectCreatePresignedURLParams implements BaseModel
{
    /** @use SdkModel<ObjectCreatePresignedURLParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $id;

    /**
     * Content type for PUT operations (optional, defaults to object's content type).
     */
    #[Api(optional: true)]
    public ?string $contentType;

    /**
     * URL expiration time in seconds (1 minute to 7 days).
     */
    #[Api(optional: true)]
    public ?int $expiresIn;

    /**
     * The S3 operation to generate URL for.
     *
     * @var value-of<Operation>|null $operation
     */
    #[Api(enum: Operation::class, optional: true)]
    public ?string $operation;

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
     * @param Operation|value-of<Operation> $operation
     */
    public static function with(
        string $id,
        ?string $contentType = null,
        ?int $expiresIn = null,
        Operation|string|null $operation = null,
    ): self {
        $obj = new self;

        $obj->id = $id;

        null !== $contentType && $obj->contentType = $contentType;
        null !== $expiresIn && $obj->expiresIn = $expiresIn;
        null !== $operation && $obj['operation'] = $operation;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Content type for PUT operations (optional, defaults to object's content type).
     */
    public function withContentType(string $contentType): self
    {
        $obj = clone $this;
        $obj->contentType = $contentType;

        return $obj;
    }

    /**
     * URL expiration time in seconds (1 minute to 7 days).
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $obj = clone $this;
        $obj->expiresIn = $expiresIn;

        return $obj;
    }

    /**
     * The S3 operation to generate URL for.
     *
     * @param Operation|value-of<Operation> $operation
     */
    public function withOperation(Operation|string $operation): self
    {
        $obj = clone $this;
        $obj['operation'] = $operation;

        return $obj;
    }
}
