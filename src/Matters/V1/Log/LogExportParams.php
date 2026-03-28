<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\Log\LogExportParams\Format;
use CaseDev\Matters\V1\Log\LogExportParams\Scope;

/**
 * Bulk export matter log entries for audits, visibility, and eval pipelines. Supports json, csv, tsv, and jsonl. Limited to 10,000 entries per request.
 *
 * @see CaseDev\Services\Matters\V1\LogService::export()
 *
 * @phpstan-import-type ScopeVariants from \CaseDev\Matters\V1\Log\LogExportParams\Scope
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogExportParams\Scope
 *
 * @phpstan-type LogExportParamsShape = array{
 *   actorID?: string|null,
 *   actorType?: string|null,
 *   endTime?: \DateTimeInterface|null,
 *   eventType?: string|null,
 *   format?: null|Format|value-of<Format>,
 *   scope?: ScopeShape|null,
 *   startTime?: \DateTimeInterface|null,
 *   workItemID?: string|null,
 * }
 */
final class LogExportParams implements BaseModel
{
    /** @use SdkModel<LogExportParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by actor ID.
     */
    #[Optional('actor_id')]
    public ?string $actorID;

    /**
     * Filter by actor type.
     */
    #[Optional('actor_type')]
    public ?string $actorType;

    /**
     * End of time range (ISO 8601).
     */
    #[Optional('end_time')]
    public ?\DateTimeInterface $endTime;

    /**
     * Filter by exact event type.
     */
    #[Optional('event_type')]
    public ?string $eventType;

    /**
     * Export format. Defaults to jsonl.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

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
    #[Optional('start_time')]
    public ?\DateTimeInterface $startTime;

    /**
     * Filter by work item ID.
     */
    #[Optional('work_item_id')]
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
     * @param Format|value-of<Format>|null $format
     * @param ScopeShape|null $scope
     */
    public static function with(
        ?string $actorID = null,
        ?string $actorType = null,
        ?\DateTimeInterface $endTime = null,
        ?string $eventType = null,
        Format|string|null $format = null,
        string|array|null $scope = null,
        ?\DateTimeInterface $startTime = null,
        ?string $workItemID = null,
    ): self {
        $self = new self;

        null !== $actorID && $self['actorID'] = $actorID;
        null !== $actorType && $self['actorType'] = $actorType;
        null !== $endTime && $self['endTime'] = $endTime;
        null !== $eventType && $self['eventType'] = $eventType;
        null !== $format && $self['format'] = $format;
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
     * Export format. Defaults to jsonl.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

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
