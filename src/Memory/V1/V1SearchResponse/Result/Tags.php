<?php

declare(strict_types=1);

namespace CaseDev\Memory\V1\V1SearchResponse\Result;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Tag values for this memory.
 *
 * @phpstan-type TagsShape = array{
 *   tag1?: string|null,
 *   tag10?: string|null,
 *   tag11?: string|null,
 *   tag12?: string|null,
 *   tag2?: string|null,
 *   tag3?: string|null,
 *   tag4?: string|null,
 *   tag5?: string|null,
 *   tag6?: string|null,
 *   tag7?: string|null,
 *   tag8?: string|null,
 *   tag9?: string|null,
 * }
 */
final class Tags implements BaseModel
{
    /** @use SdkModel<TagsShape> */
    use SdkModel;

    #[Optional('tag_1')]
    public ?string $tag1;

    #[Optional('tag_10')]
    public ?string $tag10;

    #[Optional('tag_11')]
    public ?string $tag11;

    #[Optional('tag_12')]
    public ?string $tag12;

    #[Optional('tag_2')]
    public ?string $tag2;

    #[Optional('tag_3')]
    public ?string $tag3;

    #[Optional('tag_4')]
    public ?string $tag4;

    #[Optional('tag_5')]
    public ?string $tag5;

    #[Optional('tag_6')]
    public ?string $tag6;

    #[Optional('tag_7')]
    public ?string $tag7;

    #[Optional('tag_8')]
    public ?string $tag8;

    #[Optional('tag_9')]
    public ?string $tag9;

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
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
    ): self {
        $self = new self;

        null !== $tag1 && $self['tag1'] = $tag1;
        null !== $tag10 && $self['tag10'] = $tag10;
        null !== $tag11 && $self['tag11'] = $tag11;
        null !== $tag12 && $self['tag12'] = $tag12;
        null !== $tag2 && $self['tag2'] = $tag2;
        null !== $tag3 && $self['tag3'] = $tag3;
        null !== $tag4 && $self['tag4'] = $tag4;
        null !== $tag5 && $self['tag5'] = $tag5;
        null !== $tag6 && $self['tag6'] = $tag6;
        null !== $tag7 && $self['tag7'] = $tag7;
        null !== $tag8 && $self['tag8'] = $tag8;
        null !== $tag9 && $self['tag9'] = $tag9;

        return $self;
    }

    public function withTag1(string $tag1): self
    {
        $self = clone $this;
        $self['tag1'] = $tag1;

        return $self;
    }

    public function withTag10(string $tag10): self
    {
        $self = clone $this;
        $self['tag10'] = $tag10;

        return $self;
    }

    public function withTag11(string $tag11): self
    {
        $self = clone $this;
        $self['tag11'] = $tag11;

        return $self;
    }

    public function withTag12(string $tag12): self
    {
        $self = clone $this;
        $self['tag12'] = $tag12;

        return $self;
    }

    public function withTag2(string $tag2): self
    {
        $self = clone $this;
        $self['tag2'] = $tag2;

        return $self;
    }

    public function withTag3(string $tag3): self
    {
        $self = clone $this;
        $self['tag3'] = $tag3;

        return $self;
    }

    public function withTag4(string $tag4): self
    {
        $self = clone $this;
        $self['tag4'] = $tag4;

        return $self;
    }

    public function withTag5(string $tag5): self
    {
        $self = clone $this;
        $self['tag5'] = $tag5;

        return $self;
    }

    public function withTag6(string $tag6): self
    {
        $self = clone $this;
        $self['tag6'] = $tag6;

        return $self;
    }

    public function withTag7(string $tag7): self
    {
        $self = clone $this;
        $self['tag7'] = $tag7;

        return $self;
    }

    public function withTag8(string $tag8): self
    {
        $self = clone $this;
        $self['tag8'] = $tag8;

        return $self;
    }

    public function withTag9(string $tag9): self
    {
        $self = clone $this;
        $self['tag9'] = $tag9;

        return $self;
    }
}
