<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Voice\BoostList\BoostListExtractResponse\Item;
use CaseDev\Voice\BoostList\BoostListExtractResponse\Source;

/**
 * @phpstan-import-type ItemShape from \CaseDev\Voice\BoostList\BoostListExtractResponse\Item
 *
 * @phpstan-type BoostListExtractResponseShape = array{
 *   items?: list<Item|ItemShape>|null,
 *   source?: null|Source|value-of<Source>,
 *   sourceIDs?: list<string>|null,
 * }
 */
final class BoostListExtractResponse implements BaseModel
{
    /** @use SdkModel<BoostListExtractResponseShape> */
    use SdkModel;

    /** @var list<Item>|null $items */
    #[Optional(list: Item::class)]
    public ?array $items;

    /** @var value-of<Source>|null $source */
    #[Optional(enum: Source::class)]
    public ?string $source;

    /** @var list<string>|null $sourceIDs */
    #[Optional('source_ids', list: 'string')]
    public ?array $sourceIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Item|ItemShape>|null $items
     * @param Source|value-of<Source>|null $source
     * @param list<string>|null $sourceIDs
     */
    public static function with(
        ?array $items = null,
        Source|string|null $source = null,
        ?array $sourceIDs = null
    ): self {
        $self = new self;

        null !== $items && $self['items'] = $items;
        null !== $source && $self['source'] = $source;
        null !== $sourceIDs && $self['sourceIDs'] = $sourceIDs;

        return $self;
    }

    /**
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param list<string> $sourceIDs
     */
    public function withSourceIDs(array $sourceIDs): self
    {
        $self = clone $this;
        $self['sourceIDs'] = $sourceIDs;

        return $self;
    }
}
