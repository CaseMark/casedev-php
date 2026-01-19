<?php

declare(strict_types=1);

namespace Casedev\Voice\Streaming\StreamingGetURLResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type AudioFormatShape = array{
 *   channels?: int|null, encoding?: string|null, sampleRate?: int|null
 * }
 */
final class AudioFormat implements BaseModel
{
    /** @use SdkModel<AudioFormatShape> */
    use SdkModel;

    /**
     * Number of audio channels.
     */
    #[Optional]
    public ?int $channels;

    /**
     * Required audio encoding format.
     */
    #[Optional]
    public ?string $encoding;

    /**
     * Required audio sample rate in Hz.
     */
    #[Optional('sample_rate')]
    public ?int $sampleRate;

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
        ?int $channels = null,
        ?string $encoding = null,
        ?int $sampleRate = null
    ): self {
        $self = new self;

        null !== $channels && $self['channels'] = $channels;
        null !== $encoding && $self['encoding'] = $encoding;
        null !== $sampleRate && $self['sampleRate'] = $sampleRate;

        return $self;
    }

    /**
     * Number of audio channels.
     */
    public function withChannels(int $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * Required audio encoding format.
     */
    public function withEncoding(string $encoding): self
    {
        $self = clone $this;
        $self['encoding'] = $encoding;

        return $self;
    }

    /**
     * Required audio sample rate in Hz.
     */
    public function withSampleRate(int $sampleRate): self
    {
        $self = clone $this;
        $self['sampleRate'] = $sampleRate;

        return $self;
    }
}
