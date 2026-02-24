<?php

declare(strict_types=1);

namespace CaseDev\Vault\Graphrag;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Graphrag\GraphragProcessObjectResponse\Stats;

/**
 * @phpstan-import-type StatsShape from \CaseDev\Vault\Graphrag\GraphragProcessObjectResponse\Stats
 *
 * @phpstan-type GraphragProcessObjectResponseShape = array{
 *   communities: int,
 *   entities: int,
 *   objectID: string,
 *   relationships: int,
 *   stats: Stats|StatsShape,
 *   status: string,
 *   success: bool,
 *   vaultID: string,
 * }
 */
final class GraphragProcessObjectResponse implements BaseModel
{
    /** @use SdkModel<GraphragProcessObjectResponseShape> */
    use SdkModel;

    /**
     * Number of communities detected.
     */
    #[Required]
    public int $communities;

    /**
     * Number of entities extracted.
     */
    #[Required]
    public int $entities;

    /**
     * ID of the indexed object.
     */
    #[Required('objectId')]
    public string $objectID;

    /**
     * Number of relationships extracted.
     */
    #[Required]
    public int $relationships;

    /**
     * Extraction statistics.
     */
    #[Required]
    public Stats $stats;

    /**
     * Status from GraphRAG service.
     */
    #[Required]
    public string $status;

    /**
     * Whether indexing completed successfully.
     */
    #[Required]
    public bool $success;

    /**
     * ID of the vault.
     */
    #[Required('vaultId')]
    public string $vaultID;

    /**
     * `new GraphragProcessObjectResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GraphragProcessObjectResponse::with(
     *   communities: ...,
     *   entities: ...,
     *   objectID: ...,
     *   relationships: ...,
     *   stats: ...,
     *   status: ...,
     *   success: ...,
     *   vaultID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GraphragProcessObjectResponse)
     *   ->withCommunities(...)
     *   ->withEntities(...)
     *   ->withObjectID(...)
     *   ->withRelationships(...)
     *   ->withStats(...)
     *   ->withStatus(...)
     *   ->withSuccess(...)
     *   ->withVaultID(...)
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
     * @param Stats|StatsShape $stats
     */
    public static function with(
        int $communities,
        int $entities,
        string $objectID,
        int $relationships,
        Stats|array $stats,
        string $status,
        bool $success,
        string $vaultID,
    ): self {
        $self = new self;

        $self['communities'] = $communities;
        $self['entities'] = $entities;
        $self['objectID'] = $objectID;
        $self['relationships'] = $relationships;
        $self['stats'] = $stats;
        $self['status'] = $status;
        $self['success'] = $success;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Number of communities detected.
     */
    public function withCommunities(int $communities): self
    {
        $self = clone $this;
        $self['communities'] = $communities;

        return $self;
    }

    /**
     * Number of entities extracted.
     */
    public function withEntities(int $entities): self
    {
        $self = clone $this;
        $self['entities'] = $entities;

        return $self;
    }

    /**
     * ID of the indexed object.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Number of relationships extracted.
     */
    public function withRelationships(int $relationships): self
    {
        $self = clone $this;
        $self['relationships'] = $relationships;

        return $self;
    }

    /**
     * Extraction statistics.
     *
     * @param Stats|StatsShape $stats
     */
    public function withStats(Stats|array $stats): self
    {
        $self = clone $this;
        $self['stats'] = $stats;

        return $self;
    }

    /**
     * Status from GraphRAG service.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Whether indexing completed successfully.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * ID of the vault.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
