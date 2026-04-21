<?php

declare(strict_types=1);

namespace CaseDev\Vault;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\VaultCreateParams\EmbeddingModel;

/**
 * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional GraphRAG knowledge graph features for legal document analysis and discovery.
 *
 * @see CaseDev\Services\VaultService::create()
 *
 * @phpstan-type VaultCreateParamsShape = array{
 *   name: string,
 *   description?: string|null,
 *   embeddingModel?: null|EmbeddingModel|value-of<EmbeddingModel>,
 *   enableGraph?: bool|null,
 *   enableIndexing?: bool|null,
 *   groupID?: string|null,
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
     * Optional embedding model for this vault. Defaults to openai/text-embedding-3-small. Determines the S3 Vectors index dimension and which model is used at both ingest and search time. The vault is locked to this model after creation — use a re-embed flow to change later. Ignored when enableIndexing is false.
     *
     * @var value-of<EmbeddingModel>|null $embeddingModel
     */
    #[Optional(enum: EmbeddingModel::class)]
    public ?string $embeddingModel;

    /**
     * Enable knowledge graph for entity relationship mapping. Only applies when enableIndexing is true.
     */
    #[Optional]
    public ?bool $enableGraph;

    /**
     * Enable vector indexing and search capabilities. Set to false for storage-only vaults.
     */
    #[Optional]
    public ?bool $enableIndexing;

    /**
     * Assign the vault to a vault group for access control. Required when using a group-scoped API key.
     */
    #[Optional('groupId')]
    public ?string $groupID;

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
     *
     * @param EmbeddingModel|value-of<EmbeddingModel>|null $embeddingModel
     */
    public static function with(
        string $name,
        ?string $description = null,
        EmbeddingModel|string|null $embeddingModel = null,
        ?bool $enableGraph = null,
        ?bool $enableIndexing = null,
        ?string $groupID = null,
        mixed $metadata = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $embeddingModel && $self['embeddingModel'] = $embeddingModel;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $enableIndexing && $self['enableIndexing'] = $enableIndexing;
        null !== $groupID && $self['groupID'] = $groupID;
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
     * Optional embedding model for this vault. Defaults to openai/text-embedding-3-small. Determines the S3 Vectors index dimension and which model is used at both ingest and search time. The vault is locked to this model after creation — use a re-embed flow to change later. Ignored when enableIndexing is false.
     *
     * @param EmbeddingModel|value-of<EmbeddingModel> $embeddingModel
     */
    public function withEmbeddingModel(
        EmbeddingModel|string $embeddingModel
    ): self {
        $self = clone $this;
        $self['embeddingModel'] = $embeddingModel;

        return $self;
    }

    /**
     * Enable knowledge graph for entity relationship mapping. Only applies when enableIndexing is true.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $self = clone $this;
        $self['enableGraph'] = $enableGraph;

        return $self;
    }

    /**
     * Enable vector indexing and search capabilities. Set to false for storage-only vaults.
     */
    public function withEnableIndexing(bool $enableIndexing): self
    {
        $self = clone $this;
        $self['enableIndexing'] = $enableIndexing;

        return $self;
    }

    /**
     * Assign the vault to a vault group for access control. Required when using a group-scoped API key.
     */
    public function withGroupID(string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

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
