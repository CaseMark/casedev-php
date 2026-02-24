<?php

declare(strict_types=1);

namespace CaseDev\Search\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Search\V1\V1GetResearchResponse\Model;
use CaseDev\Search\V1\V1GetResearchResponse\Results;
use CaseDev\Search\V1\V1GetResearchResponse\Status;

/**
 * @phpstan-import-type ResultsShape from \CaseDev\Search\V1\V1GetResearchResponse\Results
 *
 * @phpstan-type V1GetResearchResponseShape = array{
 *   id?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   createdAt?: \DateTimeInterface|null,
 *   model?: null|Model|value-of<Model>,
 *   progress?: float|null,
 *   query?: string|null,
 *   results?: null|Results|ResultsShape,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class V1GetResearchResponse implements BaseModel
{
    /** @use SdkModel<V1GetResearchResponseShape> */
    use SdkModel;

    /**
     * Research task ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Task completion timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $completedAt;

    /**
     * Task creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Research model used.
     *
     * @var value-of<Model>|null $model
     */
    #[Optional(enum: Model::class)]
    public ?string $model;

    /**
     * Completion percentage (0-100).
     */
    #[Optional]
    public ?float $progress;

    /**
     * Original research query.
     */
    #[Optional]
    public ?string $query;

    /**
     * Research findings and analysis.
     */
    #[Optional]
    public ?Results $results;

    /**
     * Current status of the research task.
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
     * @param Model|value-of<Model>|null $model
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $completedAt = null,
        ?\DateTimeInterface $createdAt = null,
        Model|string|null $model = null,
        ?float $progress = null,
        ?string $query = null,
        Results|array|null $results = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $model && $self['model'] = $model;
        null !== $progress && $self['progress'] = $progress;
        null !== $query && $self['query'] = $query;
        null !== $results && $self['results'] = $results;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Research task ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Task completion timestamp.
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * Task creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Research model used.
     *
     * @param Model|value-of<Model> $model
     */
    public function withModel(Model|string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Completion percentage (0-100).
     */
    public function withProgress(float $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * Original research query.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Research findings and analysis.
     *
     * @param Results|ResultsShape $results
     */
    public function withResults(Results|array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Current status of the research task.
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
