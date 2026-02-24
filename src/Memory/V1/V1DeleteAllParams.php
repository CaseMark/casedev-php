<?php

declare(strict_types=1);

namespace CaseDev\Memory\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Delete multiple memories matching tag filter criteria. CAUTION: This will delete all matching memories for your organization.
 *
 * @see CaseDev\Services\Memory\V1Service::deleteAll()
 *
 * @phpstan-type V1DeleteAllParamsShape = array{
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
final class V1DeleteAllParams implements BaseModel
{
    /** @use SdkModel<V1DeleteAllParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by tag_1.
     */
    #[Optional]
    public ?string $tag1;

    /**
     * Filter by tag_10.
     */
    #[Optional]
    public ?string $tag10;

    /**
     * Filter by tag_11.
     */
    #[Optional]
    public ?string $tag11;

    /**
     * Filter by tag_12.
     */
    #[Optional]
    public ?string $tag12;

    /**
     * Filter by tag_2.
     */
    #[Optional]
    public ?string $tag2;

    /**
     * Filter by tag_3.
     */
    #[Optional]
    public ?string $tag3;

    /**
     * Filter by tag_4.
     */
    #[Optional]
    public ?string $tag4;

    /**
     * Filter by tag_5.
     */
    #[Optional]
    public ?string $tag5;

    /**
     * Filter by tag_6.
     */
    #[Optional]
    public ?string $tag6;

    /**
     * Filter by tag_7.
     */
    #[Optional]
    public ?string $tag7;

    /**
     * Filter by tag_8.
     */
    #[Optional]
    public ?string $tag8;

    /**
     * Filter by tag_9.
     */
    #[Optional]
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

    /**
     * Filter by tag_1.
     */
    public function withTag1(string $tag1): self
    {
        $self = clone $this;
        $self['tag1'] = $tag1;

        return $self;
    }

    /**
     * Filter by tag_10.
     */
    public function withTag10(string $tag10): self
    {
        $self = clone $this;
        $self['tag10'] = $tag10;

        return $self;
    }

    /**
     * Filter by tag_11.
     */
    public function withTag11(string $tag11): self
    {
        $self = clone $this;
        $self['tag11'] = $tag11;

        return $self;
    }

    /**
     * Filter by tag_12.
     */
    public function withTag12(string $tag12): self
    {
        $self = clone $this;
        $self['tag12'] = $tag12;

        return $self;
    }

    /**
     * Filter by tag_2.
     */
    public function withTag2(string $tag2): self
    {
        $self = clone $this;
        $self['tag2'] = $tag2;

        return $self;
    }

    /**
     * Filter by tag_3.
     */
    public function withTag3(string $tag3): self
    {
        $self = clone $this;
        $self['tag3'] = $tag3;

        return $self;
    }

    /**
     * Filter by tag_4.
     */
    public function withTag4(string $tag4): self
    {
        $self = clone $this;
        $self['tag4'] = $tag4;

        return $self;
    }

    /**
     * Filter by tag_5.
     */
    public function withTag5(string $tag5): self
    {
        $self = clone $this;
        $self['tag5'] = $tag5;

        return $self;
    }

    /**
     * Filter by tag_6.
     */
    public function withTag6(string $tag6): self
    {
        $self = clone $this;
        $self['tag6'] = $tag6;

        return $self;
    }

    /**
     * Filter by tag_7.
     */
    public function withTag7(string $tag7): self
    {
        $self = clone $this;
        $self['tag7'] = $tag7;

        return $self;
    }

    /**
     * Filter by tag_8.
     */
    public function withTag8(string $tag8): self
    {
        $self = clone $this;
        $self['tag8'] = $tag8;

        return $self;
    }

    /**
     * Filter by tag_9.
     */
    public function withTag9(string $tag9): self
    {
        $self = clone $this;
        $self['tag9'] = $tag9;

        return $self;
    }
}
