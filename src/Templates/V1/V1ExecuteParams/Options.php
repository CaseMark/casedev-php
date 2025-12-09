<?php

declare(strict_types=1);

namespace Casedev\Templates\V1\V1ExecuteParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Templates\V1\V1ExecuteParams\Options\Format;

/**
 * @phpstan-type OptionsShape = array{
 *   format?: value-of<Format>|null, model?: string|null
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
        $obj = new self;

        null !== $format && $obj['format'] = $format;
        null !== $model && $obj['model'] = $model;

        return $obj;
    }

    /**
     * Output format preference.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $obj = clone $this;
        $obj['format'] = $format;

        return $obj;
    }

    /**
     * LLM model to use for processing.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }
}
