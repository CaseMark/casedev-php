<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription\TranscriptionGetResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type WordShape = array{
 *   confidence?: float|null,
 *   end?: float|null,
 *   start?: float|null,
 *   text?: string|null,
 * }
 */
final class Word implements BaseModel
{
    /** @use SdkModel<WordShape> */
    use SdkModel;

    #[Optional]
    public ?float $confidence;

    #[Optional]
    public ?float $end;

    #[Optional]
    public ?float $start;

    #[Optional]
    public ?string $text;

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
        ?float $confidence = null,
        ?float $end = null,
        ?float $start = null,
        ?string $text = null,
    ): self {
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    public function withEnd(float $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    public function withStart(float $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
