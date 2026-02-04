<?php

declare(strict_types=1);

namespace Casedev\Database\V1\V1GetUsageResponse\Project;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type CostsShape = array{
 *   branches?: string|null,
 *   compute?: string|null,
 *   storage?: string|null,
 *   total?: string|null,
 *   transfer?: string|null,
 * }
 */
final class Costs implements BaseModel
{
    /** @use SdkModel<CostsShape> */
    use SdkModel;

    #[Optional]
    public ?string $branches;

    #[Optional]
    public ?string $compute;

    #[Optional]
    public ?string $storage;

    #[Optional]
    public ?string $total;

    #[Optional]
    public ?string $transfer;

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
        ?string $branches = null,
        ?string $compute = null,
        ?string $storage = null,
        ?string $total = null,
        ?string $transfer = null,
    ): self {
        $self = new self;

        null !== $branches && $self['branches'] = $branches;
        null !== $compute && $self['compute'] = $compute;
        null !== $storage && $self['storage'] = $storage;
        null !== $total && $self['total'] = $total;
        null !== $transfer && $self['transfer'] = $transfer;

        return $self;
    }

    public function withBranches(string $branches): self
    {
        $self = clone $this;
        $self['branches'] = $branches;

        return $self;
    }

    public function withCompute(string $compute): self
    {
        $self = clone $this;
        $self['compute'] = $compute;

        return $self;
    }

    public function withStorage(string $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    public function withTotal(string $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    public function withTransfer(string $transfer): self
    {
        $self = clone $this;
        $self['transfer'] = $transfer;

        return $self;
    }
}
