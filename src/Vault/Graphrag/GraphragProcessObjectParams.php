<?php

declare(strict_types=1);

namespace CaseDev\Vault\Graphrag;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Manually trigger GraphRAG indexing for a vault object. The object must already be ingested (completed status). This extracts entities, relationships, and communities from the document for advanced knowledge graph queries.
 *
 * @see CaseDev\Services\Vault\GraphragService::processObject()
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
