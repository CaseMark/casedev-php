<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1TrademarkSearchResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type GoodsAndServiceShape = array{
 *   classNumber?: string|null, description?: string|null
 * }
 */
final class GoodsAndService implements BaseModel
{
    /** @use SdkModel<GoodsAndServiceShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $classNumber;

    #[Optional(nullable: true)]
    public ?string $description;

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
        ?string $classNumber = null,
        ?string $description = null
    ): self {
        $self = new self;

        null !== $classNumber && $self['classNumber'] = $classNumber;
        null !== $description && $self['description'] = $description;

        return $self;
    }

    public function withClassNumber(?string $classNumber): self
    {
        $self = clone $this;
        $self['classNumber'] = $classNumber;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
