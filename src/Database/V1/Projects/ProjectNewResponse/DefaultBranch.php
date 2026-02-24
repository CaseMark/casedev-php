<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects\ProjectNewResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Default 'main' branch details.
 *
 * @phpstan-type DefaultBranchShape = array{id?: string|null, name?: string|null}
 */
final class DefaultBranch implements BaseModel
{
    /** @use SdkModel<DefaultBranchShape> */
    use SdkModel;

    /**
     * Branch ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Branch name.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null, ?string $name = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Branch ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Branch name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
