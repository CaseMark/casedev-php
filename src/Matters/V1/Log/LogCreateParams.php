<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Append a manual operational note or event to a matter log.
 *
 * @see CaseDev\Services\Matters\V1\LogService::create()
 *
 * @phpstan-type LogCreateParamsShape = array{
 *   summary: string,
 *   details?: array<string,mixed>|null,
 *   eventType?: string|null,
 *   workItemID?: string|null,
 * }
 */
final class LogCreateParams implements BaseModel
{
    /** @use SdkModel<LogCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $summary;

    /** @var array<string,mixed>|null $details */
    #[Optional(map: 'mixed')]
    public ?array $details;

    #[Optional('event_type')]
    public ?string $eventType;

    #[Optional('work_item_id')]
    public ?string $workItemID;

    /**
     * `new LogCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogCreateParams::with(summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogCreateParams)->withSummary(...)
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
     * @param array<string,mixed>|null $details
     */
    public static function with(
        string $summary,
        ?array $details = null,
        ?string $eventType = null,
        ?string $workItemID = null,
    ): self {
        $self = new self;

        $self['summary'] = $summary;

        null !== $details && $self['details'] = $details;
        null !== $eventType && $self['eventType'] = $eventType;
        null !== $workItemID && $self['workItemID'] = $workItemID;

        return $self;
    }

    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param array<string,mixed> $details
     */
    public function withDetails(array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }

    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    public function withWorkItemID(string $workItemID): self
    {
        $self = clone $this;
        $self['workItemID'] = $workItemID;

        return $self;
    }
}
