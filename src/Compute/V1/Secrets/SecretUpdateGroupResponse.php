<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SecretUpdateGroupResponseShape = array{
 *   created?: float|null,
 *   group?: string|null,
 *   message?: string|null,
 *   success?: bool|null,
 *   updated?: float|null,
 * }
 */
final class SecretUpdateGroupResponse implements BaseModel
{
    /** @use SdkModel<SecretUpdateGroupResponseShape> */
    use SdkModel;

    /**
     * Number of new secrets created.
     */
    #[Optional]
    public ?float $created;

    /**
     * Name of the secret group.
     */
    #[Optional]
    public ?string $group;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?bool $success;

    /**
     * Number of existing secrets updated.
     */
    #[Optional]
    public ?float $updated;

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
        ?float $created = null,
        ?string $group = null,
        ?string $message = null,
        ?bool $success = null,
        ?float $updated = null,
    ): self {
        $self = new self;

        null !== $created && $self['created'] = $created;
        null !== $group && $self['group'] = $group;
        null !== $message && $self['message'] = $message;
        null !== $success && $self['success'] = $success;
        null !== $updated && $self['updated'] = $updated;

        return $self;
    }

    /**
     * Number of new secrets created.
     */
    public function withCreated(float $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Name of the secret group.
     */
    public function withGroup(string $group): self
    {
        $self = clone $this;
        $self['group'] = $group;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Number of existing secrets updated.
     */
    public function withUpdated(float $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }
}
