<?php

declare(strict_types=1);

namespace Casedev\Vault\Graphrag;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Manually trigger GraphRAG indexing for a vault object. The object must already be ingested (completed status). This extracts entities, relationships, and communities from the document for advanced knowledge graph queries.
 *
 * @see Casedev\Services\Vault\GraphragService::processObject()
 *
 * @phpstan-type GraphragProcessObjectParamsShape = array{id: string}
 */
final class GraphragProcessObjectParams implements BaseModel
{
    /** @use SdkModel<GraphragProcessObjectParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new GraphragProcessObjectParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GraphragProcessObjectParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GraphragProcessObjectParams)->withID(...)
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
