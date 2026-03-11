<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList\BoostListGenerateResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\BoostList\BoostListGenerateResponse\Item\BoostParam;

/**
 * @phpstan-type ItemShape = array{
 *   boostParam?: null|BoostParam|value-of<BoostParam>,
 *   category?: string|null,
 *   word?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /** @var value-of<BoostParam>|null $boostParam */
    #[Optional('boost_param', enum: BoostParam::class)]
    public ?string $boostParam;

    #[Optional]
    public ?string $category;

    #[Optional]
    public ?string $word;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BoostParam|value-of<BoostParam>|null $boostParam
     */
    public static function with(
        BoostParam|string|null $boostParam = null,
        ?string $category = null,
        ?string $word = null,
    ): self {
        $self = new self;

        null !== $boostParam && $self['boostParam'] = $boostParam;
        null !== $category && $self['category'] = $category;
        null !== $word && $self['word'] = $word;

        return $self;
    }

    /**
     * @param BoostParam|value-of<BoostParam> $boostParam
     */
    public function withBoostParam(BoostParam|string $boostParam): self
    {
        $self = clone $this;
        $self['boostParam'] = $boostParam;

        return $self;
    }

    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    public function withWord(string $word): self
    {
        $self = clone $this;
        $self['word'] = $word;

        return $self;
    }
}
