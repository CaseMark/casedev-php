<?php

declare(strict_types=1);

namespace Router\Compute\V1\Instances;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type InstanceDeleteResponseShape = array{
 *   id?: string|null,
 *   message?: string|null,
 *   name?: string|null,
 *   status?: string|null,
 *   totalCost?: string|null,
 *   totalRuntimeSeconds?: int|null,
 * }
 */
final class InstanceDeleteResponse implements BaseModel
{
    /** @use SdkModel<InstanceDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?string $totalCost;

    #[Optional]
    public ?int $totalRuntimeSeconds;

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
        ?string $message = null,
        ?string $name = null,
        ?string $status = null,
        ?string $totalCost = null,
        ?int $totalRuntimeSeconds = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $message && $self['message'] = $message;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;
        null !== $totalCost && $self['totalCost'] = $totalCost;
        null !== $totalRuntimeSeconds && $self['totalRuntimeSeconds'] = $totalRuntimeSeconds;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withTotalCost(string $totalCost): self
    {
        $self = clone $this;
        $self['totalCost'] = $totalCost;

        return $self;
    }

    public function withTotalRuntimeSeconds(int $totalRuntimeSeconds): self
    {
        $self = clone $this;
        $self['totalRuntimeSeconds'] = $totalRuntimeSeconds;

        return $self;
    }
}
