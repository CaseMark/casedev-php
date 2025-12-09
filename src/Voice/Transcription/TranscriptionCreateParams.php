<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates an asynchronous transcription job for audio files. Supports various audio formats and advanced features like speaker identification, content moderation, and automatic highlights. Returns a job ID for checking transcription status and retrieving results.
 *
 * @see Casedev\Services\Voice\TranscriptionService::create()
 *
 * @phpstan-type TranscriptionCreateParamsShape = array{
 *   audio_url: string,
 *   auto_highlights?: bool,
 *   content_safety_labels?: bool,
 *   format_text?: bool,
 *   language_code?: string,
 *   language_detection?: bool,
 *   punctuate?: bool,
 *   speaker_labels?: bool,
 * }
 */
final class TranscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<TranscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL of the audio file to transcribe.
     */
    #[Required]
    public string $audio_url;

    /**
     * Automatically extract key phrases and topics.
     */
    #[Optional]
    public ?bool $auto_highlights;

    /**
     * Enable content moderation and safety labeling.
     */
    #[Optional]
    public ?bool $content_safety_labels;

    /**
     * Format text with proper capitalization.
     */
    #[Optional]
    public ?bool $format_text;

    /**
     * Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected.
     */
    #[Optional]
    public ?string $language_code;

    /**
     * Enable automatic language detection.
     */
    #[Optional]
    public ?bool $language_detection;

    /**
     * Add punctuation to the transcript.
     */
    #[Optional]
    public ?bool $punctuate;

    /**
     * Enable speaker identification and labeling.
     */
    #[Optional]
    public ?bool $speaker_labels;

    /**
     * `new TranscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscriptionCreateParams::with(audio_url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscriptionCreateParams)->withAudioURL(...)
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
     */
    public static function with(
        string $audio_url,
        ?bool $auto_highlights = null,
        ?bool $content_safety_labels = null,
        ?bool $format_text = null,
        ?string $language_code = null,
        ?bool $language_detection = null,
        ?bool $punctuate = null,
        ?bool $speaker_labels = null,
    ): self {
        $obj = new self;

        $obj['audio_url'] = $audio_url;

        null !== $auto_highlights && $obj['auto_highlights'] = $auto_highlights;
        null !== $content_safety_labels && $obj['content_safety_labels'] = $content_safety_labels;
        null !== $format_text && $obj['format_text'] = $format_text;
        null !== $language_code && $obj['language_code'] = $language_code;
        null !== $language_detection && $obj['language_detection'] = $language_detection;
        null !== $punctuate && $obj['punctuate'] = $punctuate;
        null !== $speaker_labels && $obj['speaker_labels'] = $speaker_labels;

        return $obj;
    }

    /**
     * URL of the audio file to transcribe.
     */
    public function withAudioURL(string $audioURL): self
    {
        $obj = clone $this;
        $obj['audio_url'] = $audioURL;

        return $obj;
    }

    /**
     * Automatically extract key phrases and topics.
     */
    public function withAutoHighlights(bool $autoHighlights): self
    {
        $obj = clone $this;
        $obj['auto_highlights'] = $autoHighlights;

        return $obj;
    }

    /**
     * Enable content moderation and safety labeling.
     */
    public function withContentSafetyLabels(bool $contentSafetyLabels): self
    {
        $obj = clone $this;
        $obj['content_safety_labels'] = $contentSafetyLabels;

        return $obj;
    }

    /**
     * Format text with proper capitalization.
     */
    public function withFormatText(bool $formatText): self
    {
        $obj = clone $this;
        $obj['format_text'] = $formatText;

        return $obj;
    }

    /**
     * Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $obj = clone $this;
        $obj['language_code'] = $languageCode;

        return $obj;
    }

    /**
     * Enable automatic language detection.
     */
    public function withLanguageDetection(bool $languageDetection): self
    {
        $obj = clone $this;
        $obj['language_detection'] = $languageDetection;

        return $obj;
    }

    /**
     * Add punctuation to the transcript.
     */
    public function withPunctuate(bool $punctuate): self
    {
        $obj = clone $this;
        $obj['punctuate'] = $punctuate;

        return $obj;
    }

    /**
     * Enable speaker identification and labeling.
     */
    public function withSpeakerLabels(bool $speakerLabels): self
    {
        $obj = clone $this;
        $obj['speaker_labels'] = $speakerLabels;

        return $obj;
    }
}
