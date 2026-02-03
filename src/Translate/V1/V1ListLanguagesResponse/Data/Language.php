<?php

declare(strict_types=1);

namespace Casedev\Translate\V1\V1ListLanguagesResponse\Data;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type LanguageShape = array{language?: string|null, name?: string|null}
 */
final class Language implements BaseModel
{
    /** @use SdkModel<LanguageShape> */
    use SdkModel;

    /**
     * Language code (ISO 639-1).
     */
    #[Optional]
    public ?string $language;

    /**
     * Language name (if target specified).
     */
    #[Optional]
    public ?string $name;

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
        ?string $language = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $language && $self['language'] = $language;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Language code (ISO 639-1).
     */
    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Language name (if target specified).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
