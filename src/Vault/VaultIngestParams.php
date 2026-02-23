<?php

declare(strict_types=1);

namespace Router\Vault;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Triggers ingestion workflow for a vault object to extract text, generate chunks, and create embeddings. For supported file types (PDF, DOCX, TXT, RTF, XML, audio, video), processing happens asynchronously. For unsupported types (images, archives, etc.), the file is marked as completed immediately without text extraction. GraphRAG indexing must be triggered separately via POST /vault/:id/graphrag/:objectId.
 *
 * @see Router\Services\VaultService::ingest()
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
