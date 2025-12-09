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
 *   audioURL: string,
 *   autoHighlights?: bool,
 *   contentSafetyLabels?: bool,
 *   formatText?: bool,
 *   languageCode?: string,
 *   languageDetection?: bool,
 *   punctuate?: bool,
 *   speakerLabels?: bool,
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
    #[Required('audio_url')]
    public string $audioURL;

    /**
     * Automatically extract key phrases and topics.
     */
    #[Optional('auto_highlights')]
    public ?bool $autoHighlights;

    /**
     * Enable content moderation and safety labeling.
     */
    #[Optional('content_safety_labels')]
    public ?bool $contentSafetyLabels;

    /**
     * Format text with proper capitalization.
     */
    #[Optional('format_text')]
    public ?bool $formatText;

    /**
     * Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected.
     */
    #[Optional('language_code')]
    public ?string $languageCode;

    /**
     * Enable automatic language detection.
     */
    #[Optional('language_detection')]
    public ?bool $languageDetection;

    /**
     * Add punctuation to the transcript.
     */
    #[Optional]
    public ?bool $punctuate;

    /**
     * Enable speaker identification and labeling.
     */
    #[Optional('speaker_labels')]
    public ?bool $speakerLabels;

    /**
     * `new TranscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscriptionCreateParams::with(audioURL: ...)
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
        string $audioURL,
        ?bool $autoHighlights = null,
        ?bool $contentSafetyLabels = null,
        ?bool $formatText = null,
        ?string $languageCode = null,
        ?bool $languageDetection = null,
        ?bool $punctuate = null,
        ?bool $speakerLabels = null,
    ): self {
        $obj = new self;

        $obj['audioURL'] = $audioURL;

        null !== $autoHighlights && $obj['autoHighlights'] = $autoHighlights;
        null !== $contentSafetyLabels && $obj['contentSafetyLabels'] = $contentSafetyLabels;
        null !== $formatText && $obj['formatText'] = $formatText;
        null !== $languageCode && $obj['languageCode'] = $languageCode;
        null !== $languageDetection && $obj['languageDetection'] = $languageDetection;
        null !== $punctuate && $obj['punctuate'] = $punctuate;
        null !== $speakerLabels && $obj['speakerLabels'] = $speakerLabels;

        return $obj;
    }

    /**
     * URL of the audio file to transcribe.
     */
    public function withAudioURL(string $audioURL): self
    {
        $obj = clone $this;
        $obj['audioURL'] = $audioURL;

        return $obj;
    }

    /**
     * Automatically extract key phrases and topics.
     */
    public function withAutoHighlights(bool $autoHighlights): self
    {
        $obj = clone $this;
        $obj['autoHighlights'] = $autoHighlights;

        return $obj;
    }

    /**
     * Enable content moderation and safety labeling.
     */
    public function withContentSafetyLabels(bool $contentSafetyLabels): self
    {
        $obj = clone $this;
        $obj['contentSafetyLabels'] = $contentSafetyLabels;

        return $obj;
    }

    /**
     * Format text with proper capitalization.
     */
    public function withFormatText(bool $formatText): self
    {
        $obj = clone $this;
        $obj['formatText'] = $formatText;

        return $obj;
    }

    /**
     * Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $obj = clone $this;
        $obj['languageCode'] = $languageCode;

        return $obj;
    }

    /**
     * Enable automatic language detection.
     */
    public function withLanguageDetection(bool $languageDetection): self
    {
        $obj = clone $this;
        $obj['languageDetection'] = $languageDetection;

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
        $obj['speakerLabels'] = $speakerLabels;

        return $obj;
    }
}
