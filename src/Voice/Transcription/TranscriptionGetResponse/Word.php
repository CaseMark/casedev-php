<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription\TranscriptionGetResponse;

use Casedev\Core\Attributes\Api;
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

    #[Api(optional: true)]
    public ?float $confidence;

    #[Api(optional: true)]
    public ?float $end;

    #[Api(optional: true)]
    public ?float $start;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $confidence && $obj['confidence'] = $confidence;
        null !== $end && $obj['end'] = $end;
        null !== $start && $obj['start'] = $start;
        null !== $text && $obj['text'] = $text;

        return $obj;
    }

    public function withConfidence(float $confidence): self
    {
        $obj = clone $this;
        $obj['confidence'] = $confidence;

        return $obj;
    }

    public function withEnd(float $end): self
    {
        $obj = clone $this;
        $obj['end'] = $end;

        return $obj;
    }

    public function withStart(float $start): self
    {
        $obj = clone $this;
        $obj['start'] = $start;

        return $obj;
    }

    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }
}
