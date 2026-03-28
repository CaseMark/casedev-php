<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * List execution attempts for a work item, including agent and run linkage.
 *
 * @see CaseDev\Services\Matters\V1\WorkItemsService::listExecutions()
 *
 * @phpstan-type WorkItemListExecutionsParamsShape = array{id: string}
 */
final class WorkItemListExecutionsParams implements BaseModel
{
    /** @use SdkModel<WorkItemListExecutionsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new WorkItemListExecutionsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkItemListExecutionsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkItemListExecutionsParams)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
