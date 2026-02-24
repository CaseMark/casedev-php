<?php

declare(strict_types=1);

namespace CaseDev\Translate\V1\V1DetectResponse\Data;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DetectionShape = array{
 *   confidence?: float|null, isReliable?: bool|null, language?: string|null
 * }
 */
final class Detection implements BaseModel
{
    /** @use SdkModel<DetectionShape> */
    use SdkModel;

    /**
     * Confidence score (0-1).
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Whether the detection is reliable.
     */
    #[Optional]
    public ?bool $isReliable;

    /**
     * Detected language code (ISO 639-1).
     */
    #[Optional]
    public ?string $language;

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
        ?float $confidence = null,
        ?bool $isReliable = null,
        ?string $language = null
    ): self {
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $isReliable && $self['isReliable'] = $isReliable;
        null !== $language && $self['language'] = $language;

        return $self;
    }

    /**
     * Confidence score (0-1).
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Whether the detection is reliable.
     */
    public function withIsReliable(bool $isReliable): self
    {
        $self = clone $this;
        $self['isReliable'] = $isReliable;

        return $self;
    }

    /**
     * Detected language code (ISO 639-1).
     */
    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }
}
