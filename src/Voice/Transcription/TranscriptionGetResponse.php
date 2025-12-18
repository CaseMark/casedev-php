<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\Transcription\TranscriptionGetResponse\Status;
use Casedev\Voice\Transcription\TranscriptionGetResponse\Word;

/**
 * @phpstan-import-type WordShape from \Casedev\Voice\Transcription\TranscriptionGetResponse\Word
 *
 * @phpstan-type TranscriptionGetResponseShape = array{
 *   id: string,
 *   status: Status|value-of<Status>,
 *   audioDuration?: float|null,
 *   confidence?: float|null,
 *   error?: string|null,
 *   text?: string|null,
 *   words?: list<WordShape>|null,
 * }
 */
final class TranscriptionGetResponse implements BaseModel
{
    /** @use SdkModel<TranscriptionGetResponseShape> */
    use SdkModel;

    /**
     * Unique transcription job ID.
     */
    #[Required]
    public string $id;

    /**
     * Current status of the transcription job.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Duration of the audio file in seconds.
     */
    #[Optional('audio_duration')]
    public ?float $audioDuration;

    /**
     * Overall confidence score for the transcription.
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Error message (only present when status is error).
     */
    #[Optional]
    public ?string $error;

    /**
     * Full transcription text (only present when status is completed).
     */
    #[Optional]
    public ?string $text;

    /**
     * Word-level timestamps and confidence scores.
     *
     * @var list<Word>|null $words
     */
    #[Optional(list: Word::class)]
    public ?array $words;

    /**
     * `new TranscriptionGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscriptionGetResponse::with(id: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscriptionGetResponse)->withID(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param list<WordShape>|null $words
     */
    public static function with(
        string $id,
        Status|string $status,
        ?float $audioDuration = null,
        ?float $confidence = null,
        ?string $error = null,
        ?string $text = null,
        ?array $words = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['status'] = $status;

        null !== $audioDuration && $self['audioDuration'] = $audioDuration;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $error && $self['error'] = $error;
        null !== $text && $self['text'] = $text;
        null !== $words && $self['words'] = $words;

        return $self;
    }

    /**
     * Unique transcription job ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Current status of the transcription job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Duration of the audio file in seconds.
     */
    public function withAudioDuration(float $audioDuration): self
    {
        $self = clone $this;
        $self['audioDuration'] = $audioDuration;

        return $self;
    }

    /**
     * Overall confidence score for the transcription.
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Error message (only present when status is error).
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Full transcription text (only present when status is completed).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Word-level timestamps and confidence scores.
     *
     * @param list<WordShape> $words
     */
    public function withWords(array $words): self
    {
        $self = clone $this;
        $self['words'] = $words;

        return $self;
    }
}
