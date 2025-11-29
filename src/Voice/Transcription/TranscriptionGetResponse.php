<?php

declare(strict_types=1);

namespace Casedev\Voice\Transcription;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Voice\Transcription\TranscriptionGetResponse\Status;
use Casedev\Voice\Transcription\TranscriptionGetResponse\Word;

/**
 * @phpstan-type TranscriptionGetResponseShape = array{
 *   id: string,
 *   status: value-of<Status>,
 *   audio_duration?: float|null,
 *   confidence?: float|null,
 *   error?: string|null,
 *   text?: string|null,
 *   words?: list<Word>|null,
 * }
 */
final class TranscriptionGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TranscriptionGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique transcription job ID.
     */
    #[Api]
    public string $id;

    /**
     * Current status of the transcription job.
     *
     * @var value-of<Status> $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * Duration of the audio file in seconds.
     */
    #[Api(optional: true)]
    public ?float $audio_duration;

    /**
     * Overall confidence score for the transcription.
     */
    #[Api(optional: true)]
    public ?float $confidence;

    /**
     * Error message (only present when status is error).
     */
    #[Api(optional: true)]
    public ?string $error;

    /**
     * Full transcription text (only present when status is completed).
     */
    #[Api(optional: true)]
    public ?string $text;

    /**
     * Word-level timestamps and confidence scores.
     *
     * @var list<Word>|null $words
     */
    #[Api(list: Word::class, optional: true)]
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
     * @param list<Word> $words
     */
    public static function with(
        string $id,
        Status|string $status,
        ?float $audio_duration = null,
        ?float $confidence = null,
        ?string $error = null,
        ?string $text = null,
        ?array $words = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj['status'] = $status;

        null !== $audio_duration && $obj->audio_duration = $audio_duration;
        null !== $confidence && $obj->confidence = $confidence;
        null !== $error && $obj->error = $error;
        null !== $text && $obj->text = $text;
        null !== $words && $obj->words = $words;

        return $obj;
    }

    /**
     * Unique transcription job ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Current status of the transcription job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Duration of the audio file in seconds.
     */
    public function withAudioDuration(float $audioDuration): self
    {
        $obj = clone $this;
        $obj->audio_duration = $audioDuration;

        return $obj;
    }

    /**
     * Overall confidence score for the transcription.
     */
    public function withConfidence(float $confidence): self
    {
        $obj = clone $this;
        $obj->confidence = $confidence;

        return $obj;
    }

    /**
     * Error message (only present when status is error).
     */
    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    /**
     * Full transcription text (only present when status is completed).
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }

    /**
     * Word-level timestamps and confidence scores.
     *
     * @param list<Word> $words
     */
    public function withWords(array $words): self
    {
        $obj = clone $this;
        $obj->words = $words;

        return $obj;
    }
}
