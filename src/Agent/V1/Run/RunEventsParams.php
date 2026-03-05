<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Streams real-time run events over SSE. Supports replay using Last-Event-ID.
 *
 * @see CaseDev\Services\Agent\V1\RunService::events()
 *
 * @phpstan-type RunEventsParamsShape = array{lastEventID?: int|null}
 */
final class RunEventsParams implements BaseModel
{
    /** @use SdkModel<RunEventsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Replay events after this sequence number.
     */
    #[Optional]
    public ?int $lastEventID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $lastEventID = null): self
    {
        $self = new self;

        null !== $lastEventID && $self['lastEventID'] = $lastEventID;

        return $self;
    }

    /**
     * Replay events after this sequence number.
     */
    public function withLastEventID(int $lastEventID): self
    {
        $self = clone $this;
        $self['lastEventID'] = $lastEventID;

        return $self;
    }
}
