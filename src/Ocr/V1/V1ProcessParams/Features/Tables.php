<?php

declare(strict_types=1);

namespace Router\Ocr\V1\V1ProcessParams\Features;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Ocr\V1\V1ProcessParams\Features\Tables\Format;

/**
 * Extract tables as structured data.
 *
 * @phpstan-type TablesShape = array{format?: null|Format|value-of<Format>}
 */
final class Tables implements BaseModel
{
    /** @use SdkModel<TablesShape> */
    use SdkModel;

    /**
     * Output format for extracted tables.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Format|value-of<Format>|null $format
     */
    public static function with(Format|string|null $format = null): self
    {
        $self = new self;

        null !== $format && $self['format'] = $format;

        return $self;
    }

    /**
     * Output format for extracted tables.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
