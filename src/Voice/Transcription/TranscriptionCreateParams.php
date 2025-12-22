<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\Transcription\TranscriptionCreateParams\BoostParam;
use Casedev\Voice\Transcription\TranscriptionCreateParams\Format;

/**
 * Creates an asynchronous transcription job for audio files. Supports two modes:
 *
 * **Vault-based (recommended)**: Pass `vault_id` and `object_id` to transcribe audio from your vault. The transcript will automatically be saved back to the vault when complete.
 *
 * **Direct URL (legacy)**: Pass `audio_url` for direct transcription without automatic storage.
 *
 * @see Casedev\Services\Voice\TranscriptionService::create()
 *
 * @phpstan-type TranscriptionCreateParamsShape = array{
 *   audioURL?: string|null,
 *   autoHighlights?: bool|null,
 *   boostParam?: null|BoostParam|value-of<BoostParam>,
 *   contentSafetyLabels?: bool|null,
 *   format?: null|Format|value-of<Format>,
 *   formatText?: bool|null,
 *   languageCode?: string|null,
 *   languageDetection?: bool|null,
 *   objectID?: string|null,
 *   punctuate?: bool|null,
 *   speakerLabels?: bool|null,
 *   speakersExpected?: int|null,
 *   vaultID?: string|null,
 *   wordBoost?: list<string>|null,
 * }
 */
final class TranscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<TranscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL of the audio file to transcribe (legacy mode, no auto-storage).
     */
    #[Optional('audio_url')]
    public ?string $audioURL;

    /**
     * Automatically extract key phrases and topics.
     */
    #[Optional('auto_highlights')]
    public ?bool $autoHighlights;

    /**
     * How much to boost custom vocabulary.
     *
     * @var value-of<BoostParam>|null $boostParam
     */
    #[Optional('boost_param', enum: BoostParam::class)]
    public ?string $boostParam;

    /**
     * Enable content moderation and safety labeling.
     */
    #[Optional('content_safety_labels')]
    public ?bool $contentSafetyLabels;

    /**
     * Output format for the transcript when using vault mode.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

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
     * Object ID of the audio file in the vault (use with vault_id).
     */
    #[Optional('object_id')]
    public ?string $objectID;

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
     * Expected number of speakers (improves accuracy when known).
     */
    #[Optional('speakers_expected')]
    public ?int $speakersExpected;

    /**
     * Vault ID containing the audio file (use with object_id).
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

    /**
     * Custom vocabulary words to boost (e.g., legal terms).
     *
     * @var list<string>|null $wordBoost
     */
    #[Optional('word_boost', list: 'string')]
    public ?array $wordBoost;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BoostParam|value-of<BoostParam>|null $boostParam
     * @param Format|value-of<Format>|null $format
     * @param list<string>|null $wordBoost
     */
    public static function with(
        ?string $audioURL = null,
        ?bool $autoHighlights = null,
        BoostParam|string|null $boostParam = null,
        ?bool $contentSafetyLabels = null,
        Format|string|null $format = null,
        ?bool $formatText = null,
        ?string $languageCode = null,
        ?bool $languageDetection = null,
        ?string $objectID = null,
        ?bool $punctuate = null,
        ?bool $speakerLabels = null,
        ?int $speakersExpected = null,
        ?string $vaultID = null,
        ?array $wordBoost = null,
    ): self {
        $self = new self;

        null !== $audioURL && $self['audioURL'] = $audioURL;
        null !== $autoHighlights && $self['autoHighlights'] = $autoHighlights;
        null !== $boostParam && $self['boostParam'] = $boostParam;
        null !== $contentSafetyLabels && $self['contentSafetyLabels'] = $contentSafetyLabels;
        null !== $format && $self['format'] = $format;
        null !== $formatText && $self['formatText'] = $formatText;
        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $languageDetection && $self['languageDetection'] = $languageDetection;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $punctuate && $self['punctuate'] = $punctuate;
        null !== $speakerLabels && $self['speakerLabels'] = $speakerLabels;
        null !== $speakersExpected && $self['speakersExpected'] = $speakersExpected;
        null !== $vaultID && $self['vaultID'] = $vaultID;
        null !== $wordBoost && $self['wordBoost'] = $wordBoost;

        return $self;
    }

    /**
     * URL of the audio file to transcribe (legacy mode, no auto-storage).
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
     * How much to boost custom vocabulary.
     *
     * @param BoostParam|value-of<BoostParam> $boostParam
     */
    public function withBoostParam(BoostParam|string $boostParam): self
    {
        $self = clone $this;
        $self['boostParam'] = $boostParam;

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
     * Output format for the transcript when using vault mode.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

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
     * Object ID of the audio file in the vault (use with vault_id).
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

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

    /**
     * Expected number of speakers (improves accuracy when known).
     */
    public function withSpeakersExpected(int $speakersExpected): self
    {
        $self = clone $this;
        $self['speakersExpected'] = $speakersExpected;

        return $self;
    }

    /**
     * Vault ID containing the audio file (use with object_id).
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Custom vocabulary words to boost (e.g., legal terms).
     *
     * @param list<string> $wordBoost
     */
    public function withWordBoost(array $wordBoost): self
    {
        $self = clone $this;
        $self['wordBoost'] = $wordBoost;

        return $self;
    }
}
