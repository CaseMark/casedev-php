<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\Log\LogListParams\Scope;

/**
 * List the operational history for a matter.
 *
 * @see CaseDev\Services\Matters\V1\LogService::list()
 *
 * @phpstan-import-type ScopeVariants from \CaseDev\Matters\V1\Log\LogListParams\Scope
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogListParams\Scope
 *
 * @phpstan-type LogListParamsShape = array{
 *   actorID?: string|null,
 *   actorType?: string|null,
 *   endTime?: \DateTimeInterface|null,
 *   eventType?: string|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   scope?: ScopeShape|null,
 *   startTime?: \DateTimeInterface|null,
 *   workItemID?: string|null,
 * }
 */
final class LogListParams implements BaseModel
{
    /** @use SdkModel<LogListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by actor ID.
     */
    #[Optional]
    public ?string $actorID;

    /**
     * Filter by actor type.
     */
    #[Optional]
    public ?string $actorType;

    /**
     * End of time range (ISO 8601).
     */
    #[Optional]
    public ?\DateTimeInterface $endTime;

    /**
     * Filter by exact event type.
     */
    #[Optional]
    public ?string $eventType;

    /**
     * Maximum number of log entries to return (max 200).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of log entries to skip for pagination.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter by scope: matter, work_item, execution, sharing, all.
     *
     * @var ScopeVariants|null $scope
     */
    #[Optional(union: Scope::class)]
    public string|array|null $scope;

    /**
     * Start of time range (ISO 8601).
     */
    #[Optional]
    public ?\DateTimeInterface $startTime;

    /**
     * Filter by work item ID.
     */
    #[Optional]
    public ?string $workItemID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ScopeShape|null $scope
     */
    public static function with(
        ?string $actorID = null,
        ?string $actorType = null,
        ?\DateTimeInterface $endTime = null,
        ?string $eventType = null,
        ?int $limit = null,
        ?int $offset = null,
        string|array|null $scope = null,
        ?\DateTimeInterface $startTime = null,
        ?string $workItemID = null,
    ): self {
        $self = new self;

        null !== $actorID && $self['actorID'] = $actorID;
        null !== $actorType && $self['actorType'] = $actorType;
        null !== $endTime && $self['endTime'] = $endTime;
        null !== $eventType && $self['eventType'] = $eventType;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $scope && $self['scope'] = $scope;
        null !== $startTime && $self['startTime'] = $startTime;
        null !== $workItemID && $self['workItemID'] = $workItemID;

        return $self;
    }

    /**
     * Filter by actor ID.
     */
    public function withActorID(string $actorID): self
    {
        $self = clone $this;
        $self['actorID'] = $actorID;

        return $self;
    }

    /**
     * Filter by actor type.
     */
    public function withActorType(string $actorType): self
    {
        $self = clone $this;
        $self['actorType'] = $actorType;

        return $self;
    }

    /**
     * End of time range (ISO 8601).
     */
    public function withEndTime(\DateTimeInterface $endTime): self
    {
        $self = clone $this;
        $self['endTime'] = $endTime;

        return $self;
    }

    /**
     * Filter by exact event type.
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Maximum number of log entries to return (max 200).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of log entries to skip for pagination.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter by scope: matter, work_item, execution, sharing, all.
     *
     * @param ScopeShape $scope
     */
    public function withScope(string|array $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Start of time range (ISO 8601).
     */
    public function withStartTime(\DateTimeInterface $startTime): self
    {
        $self = clone $this;
        $self['startTime'] = $startTime;

        return $self;
    }

    /**
     * Filter by work item ID.
     */
    public function withWorkItemID(string $workItemID): self
    {
        $self = clone $this;
        $self['workItemID'] = $workItemID;

        return $self;
    }
}
