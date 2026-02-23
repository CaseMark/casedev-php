<?php

declare(strict_types=1);

namespace Router\Translate\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Translate\V1\V1ListLanguagesParams\Model;

/**
 * Get the list of languages supported for translation. Optionally specify a target language to get translated language names.
 *
 * @see Router\Services\Translate\V1Service::listLanguages()
 *
 * @phpstan-type V1ListLanguagesParamsShape = array{
 *   model?: null|Model|value-of<Model>, target?: string|null
 * }
 */
final class V1ListLanguagesParams implements BaseModel
{
    /** @use SdkModel<V1ListLanguagesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Translation model to check language support for.
     *
     * @var value-of<Model>|null $model
     */
    #[Optional(enum: Model::class)]
    public ?string $model;

    /**
     * Target language code for translating language names (e.g., 'es' for Spanish names).
     */
    #[Optional]
    public ?string $target;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Model|value-of<Model>|null $model
     */
    public static function with(
        Model|string|null $model = null,
        ?string $target = null
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $target && $self['target'] = $target;

        return $self;
    }

    /**
     * Translation model to check language support for.
     *
     * @param Model|value-of<Model> $model
     */
    public function withModel(Model|string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Target language code for translating language names (e.g., 'es' for Spanish names).
     */
    public function withTarget(string $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }
}
