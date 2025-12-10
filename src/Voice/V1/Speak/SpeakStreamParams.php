<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\V1\Speak\SpeakStreamParams\ModelID;
use Casedev\Voice\V1\Speak\SpeakStreamParams\OutputFormat;
use Casedev\Voice\V1\Speak\SpeakStreamParams\VoiceSettings;

/**
 * Convert text to speech using ElevenLabs AI voices with streaming for real-time playback. Returns audio data as an MP3 stream for immediate playback with minimal latency. Perfect for legal document narration, client presentations, or accessibility features.
 *
 * @see Casedev\Services\Voice\V1\SpeakService::stream()
 *
 * @phpstan-type SpeakStreamParamsShape = array{
 *   text: string,
 *   applyTextNormalization?: bool,
 *   enableLogging?: bool,
 *   languageCode?: string,
 *   modelID?: ModelID|value-of<ModelID>,
 *   nextText?: string,
 *   optimizeStreamingLatency?: int,
 *   outputFormat?: OutputFormat|value-of<OutputFormat>,
 *   previousText?: string,
 *   seed?: int,
 *   voiceID?: string,
 *   voiceSettings?: VoiceSettings|array{
 *     similarityBoost?: float|null,
 *     stability?: float|null,
 *     style?: float|null,
 *     useSpeakerBoost?: bool|null,
 *   },
 * }
 */
final class SpeakStreamParams implements BaseModel
{
    /** @use SdkModel<SpeakStreamParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text to convert to speech.
     */
    #[Required]
    public string $text;

    /**
     * Apply text normalization.
     */
    #[Optional('apply_text_normalization')]
    public ?bool $applyTextNormalization;

    /**
     * Enable request logging.
     */
    #[Optional('enable_logging')]
    public ?bool $enableLogging;

    /**
     * Language code (e.g., 'en', 'es', 'fr').
     */
    #[Optional('language_code')]
    public ?string $languageCode;

    /**
     * TTS model to use.
     *
     * @var value-of<ModelID>|null $modelID
     */
    #[Optional('model_id', enum: ModelID::class)]
    public ?string $modelID;

    /**
     * Next text for context.
     */
    #[Optional('next_text')]
    public ?string $nextText;

    /**
     * Optimize for streaming latency (0-4).
     */
    #[Optional('optimize_streaming_latency')]
    public ?int $optimizeStreamingLatency;

    /**
     * Audio output format.
     *
     * @var value-of<OutputFormat>|null $outputFormat
     */
    #[Optional('output_format', enum: OutputFormat::class)]
    public ?string $outputFormat;

    /**
     * Previous text for context.
     */
    #[Optional('previous_text')]
    public ?string $previousText;

    /**
     * Random seed for reproducible generation.
     */
    #[Optional]
    public ?int $seed;

    /**
     * ElevenLabs voice ID (defaults to Rachel for professional clarity).
     */
    #[Optional('voice_id')]
    public ?string $voiceID;

    #[Optional('voice_settings')]
    public ?VoiceSettings $voiceSettings;

    /**
     * `new SpeakStreamParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SpeakStreamParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SpeakStreamParams)->withText(...)
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
     * @param ModelID|value-of<ModelID> $modelID
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     * @param VoiceSettings|array{
     *   similarityBoost?: float|null,
     *   stability?: float|null,
     *   style?: float|null,
     *   useSpeakerBoost?: bool|null,
     * } $voiceSettings
     */
    public static function with(
        string $text,
        ?bool $applyTextNormalization = null,
        ?bool $enableLogging = null,
        ?string $languageCode = null,
        ModelID|string|null $modelID = null,
        ?string $nextText = null,
        ?int $optimizeStreamingLatency = null,
        OutputFormat|string|null $outputFormat = null,
        ?string $previousText = null,
        ?int $seed = null,
        ?string $voiceID = null,
        VoiceSettings|array|null $voiceSettings = null,
    ): self {
        $self = new self;

        $self['text'] = $text;

        null !== $applyTextNormalization && $self['applyTextNormalization'] = $applyTextNormalization;
        null !== $enableLogging && $self['enableLogging'] = $enableLogging;
        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $modelID && $self['modelID'] = $modelID;
        null !== $nextText && $self['nextText'] = $nextText;
        null !== $optimizeStreamingLatency && $self['optimizeStreamingLatency'] = $optimizeStreamingLatency;
        null !== $outputFormat && $self['outputFormat'] = $outputFormat;
        null !== $previousText && $self['previousText'] = $previousText;
        null !== $seed && $self['seed'] = $seed;
        null !== $voiceID && $self['voiceID'] = $voiceID;
        null !== $voiceSettings && $self['voiceSettings'] = $voiceSettings;

        return $self;
    }

    /**
     * Text to convert to speech.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Apply text normalization.
     */
    public function withApplyTextNormalization(
        bool $applyTextNormalization
    ): self {
        $self = clone $this;
        $self['applyTextNormalization'] = $applyTextNormalization;

        return $self;
    }

    /**
     * Enable request logging.
     */
    public function withEnableLogging(bool $enableLogging): self
    {
        $self = clone $this;
        $self['enableLogging'] = $enableLogging;

        return $self;
    }

    /**
     * Language code (e.g., 'en', 'es', 'fr').
     */
    public function withLanguageCode(string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * TTS model to use.
     *
     * @param ModelID|value-of<ModelID> $modelID
     */
    public function withModelID(ModelID|string $modelID): self
    {
        $self = clone $this;
        $self['modelID'] = $modelID;

        return $self;
    }

    /**
     * Next text for context.
     */
    public function withNextText(string $nextText): self
    {
        $self = clone $this;
        $self['nextText'] = $nextText;

        return $self;
    }

    /**
     * Optimize for streaming latency (0-4).
     */
    public function withOptimizeStreamingLatency(
        int $optimizeStreamingLatency
    ): self {
        $self = clone $this;
        $self['optimizeStreamingLatency'] = $optimizeStreamingLatency;

        return $self;
    }

    /**
     * Audio output format.
     *
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     */
    public function withOutputFormat(OutputFormat|string $outputFormat): self
    {
        $self = clone $this;
        $self['outputFormat'] = $outputFormat;

        return $self;
    }

    /**
     * Previous text for context.
     */
    public function withPreviousText(string $previousText): self
    {
        $self = clone $this;
        $self['previousText'] = $previousText;

        return $self;
    }

    /**
     * Random seed for reproducible generation.
     */
    public function withSeed(int $seed): self
    {
        $self = clone $this;
        $self['seed'] = $seed;

        return $self;
    }

    /**
     * ElevenLabs voice ID (defaults to Rachel for professional clarity).
     */
    public function withVoiceID(string $voiceID): self
    {
        $self = clone $this;
        $self['voiceID'] = $voiceID;

        return $self;
    }

    /**
     * @param VoiceSettings|array{
     *   similarityBoost?: float|null,
     *   stability?: float|null,
     *   style?: float|null,
     *   useSpeakerBoost?: bool|null,
     * } $voiceSettings
     */
    public function withVoiceSettings(VoiceSettings|array $voiceSettings): self
    {
        $self = clone $this;
        $self['voiceSettings'] = $voiceSettings;

        return $self;
    }
}
