<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\V1\Speak\SpeakCreateParams\ModelID;
use Casedev\Voice\V1\Speak\SpeakCreateParams\OutputFormat;
use Casedev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings;

/**
 * Convert text to natural-sounding audio using ElevenLabs voices. Ideal for creating audio summaries of legal documents, client presentations, or accessibility features. Supports multiple languages and voice customization.
 *
 * @see Casedev\Services\Voice\V1\SpeakService::create()
 *
 * @phpstan-import-type VoiceSettingsShape from \Casedev\Voice\V1\Speak\SpeakCreateParams\VoiceSettings
 *
 * @phpstan-type SpeakCreateParamsShape = array{
 *   text: string,
 *   applyTextNormalization?: bool|null,
 *   enableLogging?: bool|null,
 *   languageCode?: string|null,
 *   modelID?: null|ModelID|value-of<ModelID>,
 *   nextText?: string|null,
 *   optimizeStreamingLatency?: int|null,
 *   outputFormat?: null|OutputFormat|value-of<OutputFormat>,
 *   previousText?: string|null,
 *   seed?: int|null,
 *   voiceID?: string|null,
 *   voiceSettings?: VoiceSettingsShape|null,
 * }
 */
final class SpeakCreateParams implements BaseModel
{
    /** @use SdkModel<SpeakCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text to convert to speech.
     */
    #[Required]
    public string $text;

    /**
     * Apply automatic text normalization.
     */
    #[Optional('apply_text_normalization')]
    public ?bool $applyTextNormalization;

    /**
     * Enable request logging.
     */
    #[Optional('enable_logging')]
    public ?bool $enableLogging;

    /**
     * Language code for multilingual models.
     */
    #[Optional('language_code')]
    public ?string $languageCode;

    /**
     * ElevenLabs model ID.
     *
     * @var value-of<ModelID>|null $modelID
     */
    #[Optional('model_id', enum: ModelID::class)]
    public ?string $modelID;

    /**
     * Next context for better pronunciation.
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
     * Previous context for better pronunciation.
     */
    #[Optional('previous_text')]
    public ?string $previousText;

    /**
     * Seed for reproducible generation.
     */
    #[Optional]
    public ?int $seed;

    /**
     * ElevenLabs voice ID (defaults to Rachel - professional, clear).
     */
    #[Optional('voice_id')]
    public ?string $voiceID;

    /**
     * Voice customization settings.
     */
    #[Optional('voice_settings')]
    public ?VoiceSettings $voiceSettings;

    /**
     * `new SpeakCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SpeakCreateParams::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SpeakCreateParams)->withText(...)
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
     * @param VoiceSettingsShape $voiceSettings
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
     * Apply automatic text normalization.
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
     * Language code for multilingual models.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * ElevenLabs model ID.
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
     * Next context for better pronunciation.
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
     * Previous context for better pronunciation.
     */
    public function withPreviousText(string $previousText): self
    {
        $self = clone $this;
        $self['previousText'] = $previousText;

        return $self;
    }

    /**
     * Seed for reproducible generation.
     */
    public function withSeed(int $seed): self
    {
        $self = clone $this;
        $self['seed'] = $seed;

        return $self;
    }

    /**
     * ElevenLabs voice ID (defaults to Rachel - professional, clear).
     */
    public function withVoiceID(string $voiceID): self
    {
        $self = clone $this;
        $self['voiceID'] = $voiceID;

        return $self;
    }

    /**
     * Voice customization settings.
     *
     * @param VoiceSettingsShape $voiceSettings
     */
    public function withVoiceSettings(VoiceSettings|array $voiceSettings): self
    {
        $self = clone $this;
        $self['voiceSettings'] = $voiceSettings;

        return $self;
    }
}
