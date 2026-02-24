<?php

declare(strict_types=1);

namespace CaseDev\Translate\V1\V1TranslateResponse\Data;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type TranslationShape = array{
 *   detectedSourceLanguage?: string|null,
 *   model?: string|null,
 *   translatedText?: string|null,
 * }
 */
final class Translation implements BaseModel
{
    /** @use SdkModel<TranslationShape> */
    use SdkModel;

    /**
     * Detected source language (if source not specified).
     */
    #[Optional]
    public ?string $detectedSourceLanguage;

    /**
     * Model used for translation.
     */
    #[Optional]
    public ?string $model;

    /**
     * Translated text.
     */
    #[Optional]
    public ?string $translatedText;

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
        ?string $detectedSourceLanguage = null,
        ?string $model = null,
        ?string $translatedText = null,
    ): self {
        $self = new self;

        null !== $detectedSourceLanguage && $self['detectedSourceLanguage'] = $detectedSourceLanguage;
        null !== $model && $self['model'] = $model;
        null !== $translatedText && $self['translatedText'] = $translatedText;

        return $self;
    }

    /**
     * Detected source language (if source not specified).
     */
    public function withDetectedSourceLanguage(
        string $detectedSourceLanguage
    ): self {
        $self = clone $this;
        $self['detectedSourceLanguage'] = $detectedSourceLanguage;

        return $self;
    }

    /**
     * Model used for translation.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Translated text.
     */
    public function withTranslatedText(string $translatedText): self
    {
        $self = clone $this;
        $self['translatedText'] = $translatedText;

        return $self;
    }
}
