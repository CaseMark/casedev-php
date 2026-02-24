<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1GetCitationsResponse\Citation;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SpanShape = array{end?: int|null, start?: int|null}
 */
final class Span implements BaseModel
{
    /** @use SdkModel<SpanShape> */
    use SdkModel;

    #[Optional]
    public ?int $end;

    #[Optional]
    public ?int $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $end = null, ?int $start = null): self
    {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
