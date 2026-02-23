<?php

declare(strict_types=1);

namespace Router\Vault\Objects;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieves metadata for a specific document in a vault and generates a temporary download URL. The download URL expires after 1 hour for security. This endpoint also updates the file size if it wasn't previously calculated.
 *
 * @see Router\Services\Vault\ObjectsService::retrieve()
 *
 * @phpstan-type ObjectRetrieveParamsShape = array{id: string}
 */
final class ObjectRetrieveParams implements BaseModel
{
    /** @use SdkModel<ObjectRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ObjectRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectRetrieveParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectRetrieveParams)->withID(...)
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
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
