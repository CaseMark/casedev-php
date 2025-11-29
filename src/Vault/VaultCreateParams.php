<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates a new secure vault with dedicated S3 storage and vector search capabilities. Each vault provides isolated document storage with semantic search, OCR processing, and optional knowledge graph features for legal document analysis and discovery.
 *
 * @see Casedev\Services\VaultService::create()
 *
 * @phpstan-type VaultCreateParamsShape = array{
 *   name: string, description?: string, enableGraph?: bool
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
    #[Api]
    public string $name;

    /**
     * Optional description of the vault's purpose.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Enable knowledge graph for entity relationship mapping.
     */
    #[Api(optional: true)]
    public ?bool $enableGraph;

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
        ?bool $enableGraph = null
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $description && $obj->description = $description;
        null !== $enableGraph && $obj->enableGraph = $enableGraph;

        return $obj;
    }

    /**
     * Display name for the vault.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Optional description of the vault's purpose.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Enable knowledge graph for entity relationship mapping.
     */
    public function withEnableGraph(bool $enableGraph): self
    {
        $obj = clone $this;
        $obj->enableGraph = $enableGraph;

        return $obj;
    }
}
