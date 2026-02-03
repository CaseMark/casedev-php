<?php

declare(strict_types=1);

namespace Casedev\Translate\V1\V1ListLanguagesResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Translate\V1\V1ListLanguagesResponse\Data\Language;

/**
 * @phpstan-import-type LanguageShape from \Casedev\Translate\V1\V1ListLanguagesResponse\Data\Language
 *
 * @phpstan-type DataShape = array{languages?: list<Language|LanguageShape>|null}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<Language>|null $languages */
    #[Optional(list: Language::class)]
    public ?array $languages;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Language|LanguageShape>|null $languages
     */
    public static function with(?array $languages = null): self
    {
        $self = new self;

        null !== $languages && $self['languages'] = $languages;

        return $self;
    }

    /**
     * @param list<Language|LanguageShape> $languages
     */
    public function withLanguages(array $languages): self
    {
        $self = clone $this;
        $self['languages'] = $languages;

        return $self;
    }
}
