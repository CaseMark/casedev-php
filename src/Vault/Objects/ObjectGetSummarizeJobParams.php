<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Get the status of a CaseMark summary workflow job.
 *
 * @see CaseDev\Services\Vault\ObjectsService::getSummarizeJob()
 *
 * @phpstan-type ObjectGetSummarizeJobParamsShape = array{
 *   id: string, objectID: string
 * }
 */
final class ObjectGetSummarizeJobParams implements BaseModel
{
    /** @use SdkModel<ObjectGetSummarizeJobParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Required]
    public string $objectID;

    /**
     * `new ObjectGetSummarizeJobParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetSummarizeJobParams::with(id: ..., objectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetSummarizeJobParams)->withID(...)->withObjectID(...)
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
    public static function with(string $id, string $objectID): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['objectID'] = $objectID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }
}
