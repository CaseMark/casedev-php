<?php

declare(strict_types=1);

namespace Router\Vault\Graphrag;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Vault\Graphrag\GraphragGetStatsResponse\Status;

/**
 * @phpstan-type GraphragGetStatsResponseShape = array{
 *   communities?: int|null,
 *   documents?: int|null,
 *   entities?: int|null,
 *   lastProcessed?: \DateTimeInterface|null,
 *   relationships?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class GraphragGetStatsResponse implements BaseModel
{
    /** @use SdkModel<GraphragGetStatsResponseShape> */
    use SdkModel;

    /**
     * Number of entity communities identified.
     */
    #[Optional]
    public ?int $communities;

    /**
     * Number of processed documents.
     */
    #[Optional]
    public ?int $documents;

    /**
     * Total number of entities extracted from documents.
     */
    #[Optional]
    public ?int $entities;

    /**
     * Timestamp of last GraphRAG processing.
     */
    #[Optional]
    public ?\DateTimeInterface $lastProcessed;

    /**
     * Total number of relationships between entities.
     */
    #[Optional]
    public ?int $relationships;

    /**
     * Current processing status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?int $communities = null,
        ?int $documents = null,
        ?int $entities = null,
        ?\DateTimeInterface $lastProcessed = null,
        ?int $relationships = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $communities && $self['communities'] = $communities;
        null !== $documents && $self['documents'] = $documents;
        null !== $entities && $self['entities'] = $entities;
        null !== $lastProcessed && $self['lastProcessed'] = $lastProcessed;
        null !== $relationships && $self['relationships'] = $relationships;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Number of entity communities identified.
     */
    public function withCommunities(int $communities): self
    {
        $self = clone $this;
        $self['communities'] = $communities;

        return $self;
    }

    /**
     * Number of processed documents.
     */
    public function withDocuments(int $documents): self
    {
        $self = clone $this;
        $self['documents'] = $documents;

        return $self;
    }

    /**
     * Total number of entities extracted from documents.
     */
    public function withEntities(int $entities): self
    {
        $self = clone $this;
        $self['entities'] = $entities;

        return $self;
    }

    /**
     * Timestamp of last GraphRAG processing.
     */
    public function withLastProcessed(\DateTimeInterface $lastProcessed): self
    {
        $self = clone $this;
        $self['lastProcessed'] = $lastProcessed;

        return $self;
    }

    /**
     * Total number of relationships between entities.
     */
    public function withRelationships(int $relationships): self
    {
        $self = clone $this;
        $self['relationships'] = $relationships;

        return $self;
    }

    /**
     * Current processing status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
