<?php

declare(strict_types=1);

namespace Casedev\Superdoc\V1\V1AnnotateParams\Field;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Optional configuration (e.g., image dimensions).
 *
 * @phpstan-type OptionsShape = array{height?: float|null, width?: float|null}
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Image height in pixels.
     */
    #[Optional]
    public ?float $height;

    /**
     * Image width in pixels.
     */
    #[Optional]
    public ?float $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $height = null, ?float $width = null): self
    {
        $self = new self;

        null !== $height && $self['height'] = $height;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Image height in pixels.
     */
    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Image width in pixels.
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
