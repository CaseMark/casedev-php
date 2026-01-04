<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional GraphRAG knowledge graph features for legal document analysis and discovery.
 *
 * @see Casedev\Services\VaultService::create()
 *
 * @phpstan-type VaultCreateParamsShape = array{
 *   name: string,
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   metadata?: mixed,
 * }
 */
final class VaultCreateParams implements BaseModel
{
    /** @use SdkModel<VaultCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Display name for the vault.
     */
    #[Required]
    public string $name;

    /**
     * Optional description of the vault's purpose.
     */
    #[Optional]
    public ?string $description;

    /**
     * Enable knowledge graph for entity relationship mapping.
     */
    #[Optional]
    public ?bool $enableGraph;

    /**
     * Optional metadata to attach to the vault (e.g., { containsPHI: true } for HIPAA compliance tracking).
     */
    #[Optional]
    public mixed $metadata;

    /**
     * `new VaultCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VaultCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VaultCreateParams)->withName(...)
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
    public static function with(
        string $name,
        ?string $description = null,
        ?bool $enableGraph = null,
        mixed $metadata = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Display name for the vault.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description of the vault's purpose.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Enable knowledge graph for entity relationship mapping.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $self = clone $this;
        $self['enableGraph'] = $enableGraph;

        return $self;
    }

    /**
     * Optional metadata to attach to the vault (e.g., { containsPHI: true } for HIPAA compliance tracking).
     */
    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
