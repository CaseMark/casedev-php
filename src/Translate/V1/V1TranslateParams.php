<?php

declare(strict_types=1);

namespace Casedev\Translate\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Translate\V1\V1TranslateParams\Format;
use Casedev\Translate\V1\V1TranslateParams\Model;
use Casedev\Translate\V1\V1TranslateParams\Q;

/**
 * Translate text between languages using Google Cloud Translation API. Supports 100+ languages, automatic language detection, HTML preservation, and batch translation.
 *
 * @see Casedev\Services\Translate\V1Service::translate()
 *
 * @phpstan-import-type QVariants from \Casedev\Translate\V1\V1TranslateParams\Q
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1TranslateParams\Q
 *
 * @phpstan-type V1TranslateParamsShape = array{
 *   q: QShape,
 *   target: string,
 *   format?: null|Format|value-of<Format>,
 *   model?: null|Model|value-of<Model>,
 *   source?: string|null,
 * }
 */
final class V1TranslateParams implements BaseModel
{
    /** @use SdkModel<V1TranslateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text to translate. Can be a single string or an array for batch translation.
     *
     * @var QVariants $q
     */
    #[Required(union: Q::class)]
    public string|array $q;

    /**
     * Target language code (ISO 639-1).
     */
    #[Required]
    public string $target;

    /**
     * Format of the source text. Use 'html' to preserve HTML tags.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * Translation model. 'nmt' (Neural Machine Translation) is recommended for quality.
     *
     * @var value-of<Model>|null $model
     */
    #[Optional(enum: Model::class)]
    public ?string $model;

    /**
     * Source language code (ISO 639-1). If not specified, language is auto-detected.
     */
    #[Optional]
    public ?string $source;

    /**
     * `new V1TranslateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1TranslateParams::with(q: ..., target: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1TranslateParams)->withQ(...)->withTarget(...)
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
     * @param QShape $q
     * @param Format|value-of<Format>|null $format
     * @param Model|value-of<Model>|null $model
     */
    public static function with(
        string|array $q,
        string $target,
        Format|string|null $format = null,
        Model|string|null $model = null,
        ?string $source = null,
    ): self {
        $self = new self;

        $self['q'] = $q;
        $self['target'] = $target;

        null !== $format && $self['format'] = $format;
        null !== $model && $self['model'] = $model;
        null !== $source && $self['source'] = $source;

        return $self;
    }

    /**
     * Text to translate. Can be a single string or an array for batch translation.
     *
     * @param QShape $q
     */
    public function withQ(string|array $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * Target language code (ISO 639-1).
     */
    public function withTarget(string $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    /**
     * Format of the source text. Use 'html' to preserve HTML tags.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Translation model. 'nmt' (Neural Machine Translation) is recommended for quality.
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
     * Source language code (ISO 639-1). If not specified, language is auto-detected.
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
