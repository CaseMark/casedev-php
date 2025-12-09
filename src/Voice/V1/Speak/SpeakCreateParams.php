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
 * @phpstan-type SpeakCreateParamsShape = array{
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
        $obj = new self;

        $obj['text'] = $text;

        null !== $applyTextNormalization && $obj['applyTextNormalization'] = $applyTextNormalization;
        null !== $enableLogging && $obj['enableLogging'] = $enableLogging;
        null !== $languageCode && $obj['languageCode'] = $languageCode;
        null !== $modelID && $obj['modelID'] = $modelID;
        null !== $nextText && $obj['nextText'] = $nextText;
        null !== $optimizeStreamingLatency && $obj['optimizeStreamingLatency'] = $optimizeStreamingLatency;
        null !== $outputFormat && $obj['outputFormat'] = $outputFormat;
        null !== $previousText && $obj['previousText'] = $previousText;
        null !== $seed && $obj['seed'] = $seed;
        null !== $voiceID && $obj['voiceID'] = $voiceID;
        null !== $voiceSettings && $obj['voiceSettings'] = $voiceSettings;

        return $obj;
    }

    /**
     * Text to convert to speech.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }

    /**
     * Apply automatic text normalization.
     */
    public function withApplyTextNormalization(
        bool $applyTextNormalization
    ): self {
        $obj = clone $this;
        $obj['applyTextNormalization'] = $applyTextNormalization;

        return $obj;
    }

    /**
     * Enable request logging.
     */
    public function withEnableLogging(bool $enableLogging): self
    {
        $obj = clone $this;
        $obj['enableLogging'] = $enableLogging;

        return $obj;
    }

    /**
     * Language code for multilingual models.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $obj = clone $this;
        $obj['languageCode'] = $languageCode;

        return $obj;
    }

    /**
     * ElevenLabs model ID.
     *
     * @param ModelID|value-of<ModelID> $modelID
     */
    public function withModelID(ModelID|string $modelID): self
    {
        $obj = clone $this;
        $obj['modelID'] = $modelID;

        return $obj;
    }

    /**
     * Next context for better pronunciation.
     */
    public function withNextText(string $nextText): self
    {
        $obj = clone $this;
        $obj['nextText'] = $nextText;

        return $obj;
    }

    /**
     * Optimize for streaming latency (0-4).
     */
    public function withOptimizeStreamingLatency(
        int $optimizeStreamingLatency
    ): self {
        $obj = clone $this;
        $obj['optimizeStreamingLatency'] = $optimizeStreamingLatency;

        return $obj;
    }

    /**
     * Audio output format.
     *
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     */
    public function withOutputFormat(OutputFormat|string $outputFormat): self
    {
        $obj = clone $this;
        $obj['outputFormat'] = $outputFormat;

        return $obj;
    }

    /**
     * Previous context for better pronunciation.
     */
    public function withPreviousText(string $previousText): self
    {
        $obj = clone $this;
        $obj['previousText'] = $previousText;

        return $obj;
    }

    /**
     * Seed for reproducible generation.
     */
    public function withSeed(int $seed): self
    {
        $obj = clone $this;
        $obj['seed'] = $seed;

        return $obj;
    }

    /**
     * ElevenLabs voice ID (defaults to Rachel - professional, clear).
     */
    public function withVoiceID(string $voiceID): self
    {
        $obj = clone $this;
        $obj['voiceID'] = $voiceID;

        return $obj;
    }

    /**
     * Voice customization settings.
     *
     * @param VoiceSettings|array{
     *   similarityBoost?: float|null,
     *   stability?: float|null,
     *   style?: float|null,
     *   useSpeakerBoost?: bool|null,
     * } $voiceSettings
     */
    public function withVoiceSettings(VoiceSettings|array $voiceSettings): self
    {
        $obj = clone $this;
        $obj['voiceSettings'] = $voiceSettings;

        return $obj;
    }
}
