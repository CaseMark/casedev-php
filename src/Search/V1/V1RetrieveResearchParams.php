<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve the status and results of a deep research task by ID. Supports both standard JSON responses and streaming for real-time updates as the research progresses. Research tasks analyze topics comprehensively using web search and AI synthesis.
 *
 * @see Casedev\Services\Search\V1Service::retrieveResearch()
 *
 * @phpstan-type V1RetrieveResearchParamsShape = array{
 *   events?: string, stream?: bool
 * }
 */
final class V1RetrieveResearchParams implements BaseModel
{
    /** @use SdkModel<V1RetrieveResearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter specific event types for streaming.
     */
    #[Optional]
    public ?string $events;

    /**
     * Enable streaming for real-time updates.
     */
    #[Optional]
    public ?bool $stream;

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
        ?string $events = null,
        ?bool $stream = null
    ): self {
        $self = new self;

        null !== $events && $self['events'] = $events;
        null !== $stream && $self['stream'] = $stream;

        return $self;
    }

    /**
     * Filter specific event types for streaming.
     */
    public function withEvents(string $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Enable streaming for real-time updates.
     */
    public function withStream(bool $stream): self
    {
        $self = clone $this;
        $self['stream'] = $stream;

        return $self;
    }
}
