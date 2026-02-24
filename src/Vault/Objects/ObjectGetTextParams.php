<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Retrieves the full extracted text content from a processed vault object. Returns the concatenated text from all chunks, useful for document review, analysis, or export. The object must have completed processing before text can be retrieved.
 *
 * @see CaseDev\Services\Vault\ObjectsService::getText()
 *
 * @phpstan-type ObjectGetTextParamsShape = array{id: string}
 */
final class ObjectGetTextParams implements BaseModel
{
    /** @use SdkModel<ObjectGetTextParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ObjectGetTextParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetTextParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetTextParams)->withID(...)
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
