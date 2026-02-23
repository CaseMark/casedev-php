<?php

declare(strict_types=1);

namespace Router\Translate\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Translate\V1\V1DetectResponse\Data;

/**
 * @phpstan-import-type DataShape from \Router\Translate\V1\V1DetectResponse\Data
 *
 * @phpstan-type V1DetectResponseShape = array{data?: null|Data|DataShape}
 */
final class V1DetectResponse implements BaseModel
{
    /** @use SdkModel<V1DetectResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Data $data;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Data|DataShape|null $data
     */
    public static function with(Data|array|null $data = null): self
    {
        $self = new self;

        null !== $data && $self['data'] = $data;

        return $self;
    }

    /**
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
