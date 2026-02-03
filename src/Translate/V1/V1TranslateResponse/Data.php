<?php

declare(strict_types=1);

namespace Casedev\Translate\V1\V1TranslateResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Translate\V1\V1TranslateResponse\Data\Translation;

/**
 * @phpstan-import-type TranslationShape from \Casedev\Translate\V1\V1TranslateResponse\Data\Translation
 *
 * @phpstan-type DataShape = array{
 *   translations?: list<Translation|TranslationShape>|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<Translation>|null $translations */
    #[Optional(list: Translation::class)]
    public ?array $translations;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Translation|TranslationShape>|null $translations
     */
    public static function with(?array $translations = null): self
    {
        $self = new self;

        null !== $translations && $self['translations'] = $translations;

        return $self;
    }

    /**
     * @param list<Translation|TranslationShape> $translations
     */
    public function withTranslations(array $translations): self
    {
        $self = clone $this;
        $self['translations'] = $translations;

        return $self;
    }
}
