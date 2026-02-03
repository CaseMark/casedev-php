<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Get the status of a CaseMark summary workflow job. If the job has been processing for too long, this endpoint will poll CaseMark directly to recover stuck jobs.
 *
 * @see Casedev\Services\Vault\ObjectsService::getSummarizeJob()
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
