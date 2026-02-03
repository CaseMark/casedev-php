<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1DeleteResponse\ResourcesDeleted;

/**
 * @phpstan-import-type ResourcesDeletedShape from \Casedev\Projects\V1\V1DeleteResponse\ResourcesDeleted
 *
 * @phpstan-type V1DeleteResponseShape = array{
 *   id?: string|null,
 *   deploymentsDeleted?: float|null,
 *   message?: string|null,
 *   resourcesDeleted?: null|ResourcesDeleted|ResourcesDeletedShape,
 *   status?: string|null,
 * }
 */
final class V1DeleteResponse implements BaseModel
{
    /** @use SdkModel<V1DeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?float $deploymentsDeleted;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?ResourcesDeleted $resourcesDeleted;

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
     *
     * @param ResourcesDeleted|ResourcesDeletedShape|null $resourcesDeleted
     */
    public static function with(
        ?string $id = null,
        ?float $deploymentsDeleted = null,
        ?string $message = null,
        ResourcesDeleted|array|null $resourcesDeleted = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $deploymentsDeleted && $self['deploymentsDeleted'] = $deploymentsDeleted;
        null !== $message && $self['message'] = $message;
        null !== $resourcesDeleted && $self['resourcesDeleted'] = $resourcesDeleted;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDeploymentsDeleted(float $deploymentsDeleted): self
    {
        $self = clone $this;
        $self['deploymentsDeleted'] = $deploymentsDeleted;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * @param ResourcesDeleted|ResourcesDeletedShape $resourcesDeleted
     */
    public function withResourcesDeleted(
        ResourcesDeleted|array $resourcesDeleted
    ): self {
        $self = clone $this;
        $self['resourcesDeleted'] = $resourcesDeleted;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
