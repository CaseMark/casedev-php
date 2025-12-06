<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak;

use Casedev\Core\Attributes\Api;
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
 *   apply_text_normalization?: bool,
 *   enable_logging?: bool,
 *   language_code?: string,
 *   model_id?: ModelID|value-of<ModelID>,
 *   next_text?: string,
 *   optimize_streaming_latency?: int,
 *   output_format?: OutputFormat|value-of<OutputFormat>,
 *   previous_text?: string,
 *   seed?: int,
 *   voice_id?: string,
 *   voice_settings?: VoiceSettings|array{
 *     similarity_boost?: float|null,
 *     stability?: float|null,
 *     style?: float|null,
 *     use_speaker_boost?: bool|null,
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
    #[Api]
    public string $text;

    /**
     * Apply text normalization.
     */
    #[Api(optional: true)]
    public ?bool $apply_text_normalization;

    /**
     * Enable request logging.
     */
    #[Api(optional: true)]
    public ?bool $enable_logging;

    /**
     * Language code (e.g., 'en', 'es', 'fr').
     */
    #[Api(optional: true)]
    public ?string $language_code;

    /**
     * TTS model to use.
     *
     * @var value-of<ModelID>|null $model_id
     */
    #[Api(enum: ModelID::class, optional: true)]
    public ?string $model_id;

    /**
     * Next text for context.
     */
    #[Api(optional: true)]
    public ?string $next_text;

    /**
     * Optimize for streaming latency (0-4).
     */
    #[Api(optional: true)]
    public ?int $optimize_streaming_latency;

    /**
     * Audio output format.
     *
     * @var value-of<OutputFormat>|null $output_format
     */
    #[Api(enum: OutputFormat::class, optional: true)]
    public ?string $output_format;

    /**
     * Previous text for context.
     */
    #[Api(optional: true)]
    public ?string $previous_text;

    /**
     * Random seed for reproducible generation.
     */
    #[Api(optional: true)]
    public ?int $seed;

    /**
     * ElevenLabs voice ID (defaults to Rachel for professional clarity).
     */
    #[Api(optional: true)]
    public ?string $voice_id;

    #[Api(optional: true)]
    public ?VoiceSettings $voice_settings;

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
     * @param ModelID|value-of<ModelID> $model_id
     * @param OutputFormat|value-of<OutputFormat> $output_format
     * @param VoiceSettings|array{
     *   similarity_boost?: float|null,
     *   stability?: float|null,
     *   style?: float|null,
     *   use_speaker_boost?: bool|null,
     * } $voice_settings
     */
    public static function with(
        string $text,
        ?bool $apply_text_normalization = null,
        ?bool $enable_logging = null,
        ?string $language_code = null,
        ModelID|string|null $model_id = null,
        ?string $next_text = null,
        ?int $optimize_streaming_latency = null,
        OutputFormat|string|null $output_format = null,
        ?string $previous_text = null,
        ?int $seed = null,
        ?string $voice_id = null,
        VoiceSettings|array|null $voice_settings = null,
    ): self {
        $obj = new self;

        $obj['text'] = $text;

        null !== $apply_text_normalization && $obj['apply_text_normalization'] = $apply_text_normalization;
        null !== $enable_logging && $obj['enable_logging'] = $enable_logging;
        null !== $language_code && $obj['language_code'] = $language_code;
        null !== $model_id && $obj['model_id'] = $model_id;
        null !== $next_text && $obj['next_text'] = $next_text;
        null !== $optimize_streaming_latency && $obj['optimize_streaming_latency'] = $optimize_streaming_latency;
        null !== $output_format && $obj['output_format'] = $output_format;
        null !== $previous_text && $obj['previous_text'] = $previous_text;
        null !== $seed && $obj['seed'] = $seed;
        null !== $voice_id && $obj['voice_id'] = $voice_id;
        null !== $voice_settings && $obj['voice_settings'] = $voice_settings;

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
     * Apply text normalization.
     */
    public function withApplyTextNormalization(
        bool $applyTextNormalization
    ): self {
        $obj = clone $this;
        $obj['apply_text_normalization'] = $applyTextNormalization;

        return $obj;
    }

    /**
     * Enable request logging.
     */
    public function withEnableLogging(bool $enableLogging): self
    {
        $obj = clone $this;
        $obj['enable_logging'] = $enableLogging;

        return $obj;
    }

    /**
     * Language code (e.g., 'en', 'es', 'fr').
     */
    public function withLanguageCode(string $languageCode): self
    {
        $obj = clone $this;
        $obj['language_code'] = $languageCode;

        return $obj;
    }

    /**
     * TTS model to use.
     *
     * @param ModelID|value-of<ModelID> $modelID
     */
    public function withModelID(ModelID|string $modelID): self
    {
        $obj = clone $this;
        $obj['model_id'] = $modelID;

        return $obj;
    }

    /**
     * Next text for context.
     */
    public function withNextText(string $nextText): self
    {
        $obj = clone $this;
        $obj['next_text'] = $nextText;

        return $obj;
    }

    /**
     * Optimize for streaming latency (0-4).
     */
    public function withOptimizeStreamingLatency(
        int $optimizeStreamingLatency
    ): self {
        $obj = clone $this;
        $obj['optimize_streaming_latency'] = $optimizeStreamingLatency;

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
        $obj['output_format'] = $outputFormat;

        return $obj;
    }

    /**
     * Previous text for context.
     */
    public function withPreviousText(string $previousText): self
    {
        $obj = clone $this;
        $obj['previous_text'] = $previousText;

        return $obj;
    }

    /**
     * Random seed for reproducible generation.
     */
    public function withSeed(int $seed): self
    {
        $obj = clone $this;
        $obj['seed'] = $seed;

        return $obj;
    }

    /**
     * ElevenLabs voice ID (defaults to Rachel for professional clarity).
     */
    public function withVoiceID(string $voiceID): self
    {
        $obj = clone $this;
        $obj['voice_id'] = $voiceID;

        return $obj;
    }

    /**
     * @param VoiceSettings|array{
     *   similarity_boost?: float|null,
     *   stability?: float|null,
     *   style?: float|null,
     *   use_speaker_boost?: bool|null,
     * } $voiceSettings
     */
    public function withVoiceSettings(VoiceSettings|array $voiceSettings): self
    {
        $obj = clone $this;
        $obj['voice_settings'] = $voiceSettings;

        return $obj;
    }
}
