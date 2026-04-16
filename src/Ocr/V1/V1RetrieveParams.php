<?php

declare(strict_types=1);

namespace CaseDev\Ocr\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Ocr\V1\V1RetrieveParams\IncludeText;

/**
 * Retrieve the status and results of an OCR job. Returns job progress, extracted text, and metadata when processing is complete.
 *
 * @see CaseDev\Services\Ocr\V1Service::retrieve()
 *
 * @phpstan-type V1RetrieveParamsShape = array{
 *   includeText?: null|IncludeText|value-of<IncludeText>
 * }
 */
final class V1RetrieveParams implements BaseModel
{
    /** @use SdkModel<V1RetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Include full OCR text in completed responses (default: true).
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
     * Include full OCR text in completed responses (default: true).
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
