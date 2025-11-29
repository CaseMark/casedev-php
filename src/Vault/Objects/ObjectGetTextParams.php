<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieves the full extracted text content from a processed vault object. Returns the concatenated text from all chunks, useful for document review, analysis, or export. The object must have completed processing before text can be retrieved.
 *
 * @see Casedev\Services\Vault\ObjectsService::getText()
 *
 * @phpstan-type ObjectGetTextParamsShape = array{id: string}
 */
final class ObjectGetTextParams implements BaseModel
{
    /** @use SdkModel<ObjectGetTextParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
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
        $obj = new self;

        $obj->id = $id;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }
}
