<?php

declare(strict_types=1);

namespace Casedev\Memory\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1DeleteAllResponseShape = array{deleted?: int|null}
 */
final class V1DeleteAllResponse implements BaseModel
{
    /** @use SdkModel<V1DeleteAllResponseShape> */
    use SdkModel;

    /**
     * Number of memories deleted.
     */
    #[Optional]
    public ?int $deleted;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $deleted = null): self
    {
        $self = new self;

        null !== $deleted && $self['deleted'] = $deleted;

        return $self;
    }

    /**
     * Number of memories deleted.
     */
    public function withDeleted(int $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }
}
