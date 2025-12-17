<?php

declare(strict_types=1);

namespace Casedev\Templates\V1\V1ExecuteParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Templates\V1\V1ExecuteParams\Options\Format;

/**
 * @phpstan-type OptionsShape = array{
 *   format?: null|Format|value-of<Format>, model?: string|null
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Output format preference.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * LLM model to use for processing.
     */
    #[Optional]
    public ?string $model;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Format|value-of<Format> $format
     */
    public static function with(
        Format|string|null $format = null,
        ?string $model = null
    ): self {
        $self = new self;

        null !== $format && $self['format'] = $format;
        null !== $model && $self['model'] = $model;

        return $self;
    }

    /**
     * Output format preference.
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
     * LLM model to use for processing.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }
}
