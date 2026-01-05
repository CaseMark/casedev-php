<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Triggers OCR ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. Processing happens asynchronously. GraphRAG indexing must be triggered separately via POST /vault/:id/graphrag/:objectId. Returns immediately with workflow tracking information.
 *
 * @see Casedev\Services\VaultService::ingest()
 *
 * @phpstan-type VaultIngestParamsShape = array{id: string}
 */
final class VaultIngestParams implements BaseModel
{
    /** @use SdkModel<VaultIngestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new VaultIngestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultIngestParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultIngestParams)->withID(...)
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
