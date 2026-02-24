<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Agent\V1\Run\RunCancelResponse\Status;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type RunCancelResponseShape = array{
 *   id?: string|null, message?: string|null, status?: null|Status|value-of<Status>
 * }
 */
final class RunCancelResponse implements BaseModel
{
    /** @use SdkModel<RunCancelResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    /**
     * Present if run was already finished.
     */
    #[Optional]
    public ?string $message;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?string $message = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $message && $self['message'] = $message;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Present if run was already finished.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
