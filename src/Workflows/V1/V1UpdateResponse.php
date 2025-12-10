<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1UpdateResponseShape = array{
 *   id?: string|null, name?: string|null, updatedAt?: string|null
 * }
 */
final class V1UpdateResponse implements BaseModel
{
    /** @use SdkModel<V1UpdateResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $updatedAt;

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
        ?string $id = null,
        ?string $name = null,
        ?string $updatedAt = null
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
