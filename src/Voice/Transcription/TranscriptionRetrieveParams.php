<?php

declare(strict_types=1);

namespace CaseDev\Voice\Transcription;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\Transcription\TranscriptionRetrieveParams\IncludeText;

/**
 * Retrieve the status and result of an audio transcription job. For vault-based jobs, returns status and result_object_id when complete. For legacy direct URL jobs, returns the full transcription data.
 *
 * @see CaseDev\Services\Voice\TranscriptionService::retrieve()
 *
 * @phpstan-type TranscriptionRetrieveParamsShape = array{
 *   includeText?: null|IncludeText|value-of<IncludeText>
 * }
 */
final class TranscriptionRetrieveParams implements BaseModel
{
    /** @use SdkModel<TranscriptionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Include full transcript text in response for vault-based jobs (default: false).
     *
     * @var value-of<IncludeText>|null $includeText
     */
    #[Optional(enum: IncludeText::class)]
    public ?string $includeText;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param IncludeText|value-of<IncludeText>|null $includeText
     */
    public static function with(IncludeText|string|null $includeText = null): self
    {
        $self = new self;

        null !== $includeText && $self['includeText'] = $includeText;

        return $self;
    }

    /**
     * Include full transcript text in response for vault-based jobs (default: false).
     *
     * @param IncludeText|value-of<IncludeText> $includeText
     */
    public function withIncludeText(IncludeText|string $includeText): self
    {
        $self = clone $this;
        $self['includeText'] = $includeText;

        return $self;
    }
}
