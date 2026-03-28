<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * List active work items for a matter.
 *
 * @see CaseDev\Services\Matters\V1\WorkItemsService::list()
 *
 * @phpstan-type WorkItemListParamsShape = array{
 *   assigneeID?: string|null, status?: string|null
 * }
 */
final class WorkItemListParams implements BaseModel
{
    /** @use SdkModel<WorkItemListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $assigneeID;

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
        ?string $assigneeID = null,
        ?string $status = null
    ): self {
        $self = new self;

        null !== $assigneeID && $self['assigneeID'] = $assigneeID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withAssigneeID(string $assigneeID): self
    {
        $self = clone $this;
        $self['assigneeID'] = $assigneeID;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
