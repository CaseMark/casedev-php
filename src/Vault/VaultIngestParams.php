<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Triggers OCR ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. Processing happens asynchronously with GraphRAG support if enabled on the vault. Returns immediately with workflow tracking information.
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

    #[Api]
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
        $obj = new self;

        $obj['id'] = $id;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }
}
