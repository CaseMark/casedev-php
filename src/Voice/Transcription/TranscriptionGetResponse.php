<?php

declare(strict_types=1);

namespace Router\Voice\Transcription;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Voice\Transcription\TranscriptionGetResponse\Status;

/**
 * @phpstan-type TranscriptionGetResponseShape = array{
 *   id: string,
 *   status: Status|value-of<Status>,
 *   audioDuration?: float|null,
 *   confidence?: float|null,
 *   error?: string|null,
 *   resultObjectID?: string|null,
 *   sourceObjectID?: string|null,
 *   text?: string|null,
 *   vaultID?: string|null,
 *   wordCount?: int|null,
 *   words?: list<mixed>|null,
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
     * Overall confidence score (0-100).
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Error message (only present when status is failed).
     */
    #[Optional]
    public ?string $error;

    /**
     * Result transcript object ID (vault-based jobs, when completed).
     */
    #[Optional('result_object_id')]
    public ?string $resultObjectID;

    /**
     * Source audio object ID (vault-based jobs only).
     */
    #[Optional('source_object_id')]
    public ?string $sourceObjectID;

    /**
     * Full transcription text (legacy direct URL jobs only).
     */
    #[Optional]
    public ?string $text;

    /**
     * Vault ID (vault-based jobs only).
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

    /**
     * Number of words in the transcript.
     */
    #[Optional('word_count')]
    public ?int $wordCount;

    /**
     * Word-level timestamps (legacy direct URL jobs only).
     *
     * @var list<mixed>|null $words
     */
    #[Optional(list: 'mixed')]
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
     * @param list<mixed>|null $words
     */
    public static function with(
        string $id,
        Status|string $status,
        ?float $audioDuration = null,
        ?float $confidence = null,
        ?string $error = null,
        ?string $resultObjectID = null,
        ?string $sourceObjectID = null,
        ?string $text = null,
        ?string $vaultID = null,
        ?int $wordCount = null,
        ?array $words = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['status'] = $status;

        null !== $audioDuration && $self['audioDuration'] = $audioDuration;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $error && $self['error'] = $error;
        null !== $resultObjectID && $self['resultObjectID'] = $resultObjectID;
        null !== $sourceObjectID && $self['sourceObjectID'] = $sourceObjectID;
        null !== $text && $self['text'] = $text;
        null !== $vaultID && $self['vaultID'] = $vaultID;
        null !== $wordCount && $self['wordCount'] = $wordCount;
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
     * Overall confidence score (0-100).
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Error message (only present when status is failed).
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Result transcript object ID (vault-based jobs, when completed).
     */
    public function withResultObjectID(string $resultObjectID): self
    {
        $self = clone $this;
        $self['resultObjectID'] = $resultObjectID;

        return $self;
    }

    /**
     * Source audio object ID (vault-based jobs only).
     */
    public function withSourceObjectID(string $sourceObjectID): self
    {
        $self = clone $this;
        $self['sourceObjectID'] = $sourceObjectID;

        return $self;
    }

    /**
     * Full transcription text (legacy direct URL jobs only).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Vault ID (vault-based jobs only).
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Number of words in the transcript.
     */
    public function withWordCount(int $wordCount): self
    {
        $self = clone $this;
        $self['wordCount'] = $wordCount;

        return $self;
    }

    /**
     * Word-level timestamps (legacy direct URL jobs only).
     *
     * @param list<mixed> $words
     */
    public function withWords(array $words): self
    {
        $self = clone $this;
        $self['words'] = $words;

        return $self;
    }
}
