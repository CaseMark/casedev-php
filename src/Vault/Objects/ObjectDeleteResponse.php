<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectDeleteResponse\DeletedObject;

/**
 * @phpstan-import-type DeletedObjectShape from \CaseDev\Vault\Objects\ObjectDeleteResponse\DeletedObject
 *
 * @phpstan-type ObjectDeleteResponseShape = array{
 *   deletedObject?: null|DeletedObject|DeletedObjectShape, success?: bool|null
 * }
 */
final class ObjectDeleteResponse implements BaseModel
{
    /** @use SdkModel<ObjectDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?DeletedObject $deletedObject;

    #[Optional]
    public ?bool $success;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DeletedObject|DeletedObjectShape|null $deletedObject
     */
    public static function with(
        DeletedObject|array|null $deletedObject = null,
        ?bool $success = null
    ): self {
        $self = new self;

        null !== $deletedObject && $self['deletedObject'] = $deletedObject;
        null !== $success && $self['success'] = $success;

        return $self;
    }

    /**
     * @param DeletedObject|DeletedObjectShape $deletedObject
     */
    public function withDeletedObject(DeletedObject|array $deletedObject): self
    {
        $self = clone $this;
        $self['deletedObject'] = $deletedObject;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
