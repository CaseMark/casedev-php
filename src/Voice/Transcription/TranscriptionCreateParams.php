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
        $self = new self;

        $self['audioURL'] = $audioURL;

        null !== $autoHighlights && $self['autoHighlights'] = $autoHighlights;
        null !== $contentSafetyLabels && $self['contentSafetyLabels'] = $contentSafetyLabels;
        null !== $formatText && $self['formatText'] = $formatText;
        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $languageDetection && $self['languageDetection'] = $languageDetection;
        null !== $punctuate && $self['punctuate'] = $punctuate;
        null !== $speakerLabels && $self['speakerLabels'] = $speakerLabels;

        return $self;
    }

    /**
     * URL of the audio file to transcribe.
     */
    public function withAudioURL(string $audioURL): self
    {
        $self = clone $this;
        $self['audioURL'] = $audioURL;

        return $self;
    }

    /**
     * Automatically extract key phrases and topics.
     */
    public function withAutoHighlights(bool $autoHighlights): self
    {
        $self = clone $this;
        $self['autoHighlights'] = $autoHighlights;

        return $self;
    }

    /**
     * Enable content moderation and safety labeling.
     */
    public function withContentSafetyLabels(bool $contentSafetyLabels): self
    {
        $self = clone $this;
        $self['contentSafetyLabels'] = $contentSafetyLabels;

        return $self;
    }

    /**
     * Format text with proper capitalization.
     */
    public function withFormatText(bool $formatText): self
    {
        $self = clone $this;
        $self['formatText'] = $formatText;

        return $self;
    }

    /**
     * Language code (e.g., 'en_us', 'es', 'fr'). If not specified, language will be auto-detected.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * Enable automatic language detection.
     */
    public function withLanguageDetection(bool $languageDetection): self
    {
        $self = clone $this;
        $self['languageDetection'] = $languageDetection;

        return $self;
    }

    /**
     * Add punctuation to the transcript.
     */
    public function withPunctuate(bool $punctuate): self
    {
        $self = clone $this;
        $self['punctuate'] = $punctuate;

        return $self;
    }

    /**
     * Enable speaker identification and labeling.
     */
    public function withSpeakerLabels(bool $speakerLabels): self
    {
        $self = clone $this;
        $self['speakerLabels'] = $speakerLabels;

        return $self;
    }
}
