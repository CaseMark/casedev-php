<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChatDeleteResponseShape = array{
 *   id?: string|null,
 *   cost?: float|null,
 *   runtimeMs?: int|null,
 *   snapshotImageID?: string|null,
 *   status?: string|null,
 * }
 */
final class ChatDeleteResponse implements BaseModel
{
    /** @use SdkModel<ChatDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?float $cost;

    #[Optional]
    public ?int $runtimeMs;

    #[Optional('snapshotImageId', nullable: true)]
    public ?string $snapshotImageID;

    #[Optional]
    public ?string $status;

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
        ?float $cost = null,
        ?int $runtimeMs = null,
        ?string $snapshotImageID = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $cost && $self['cost'] = $cost;
        null !== $runtimeMs && $self['runtimeMs'] = $runtimeMs;
        null !== $snapshotImageID && $self['snapshotImageID'] = $snapshotImageID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCost(float $cost): self
    {
        $self = clone $this;
        $self['cost'] = $cost;

        return $self;
    }

    public function withRuntimeMs(int $runtimeMs): self
    {
        $self = clone $this;
        $self['runtimeMs'] = $runtimeMs;

        return $self;
    }

    public function withSnapshotImageID(?string $snapshotImageID): self
    {
        $self = clone $this;
        $self['snapshotImageID'] = $snapshotImageID;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
