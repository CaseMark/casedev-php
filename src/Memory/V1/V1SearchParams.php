<?php

declare(strict_types=1);

namespace Router\Memory\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Search memories using semantic similarity. Filter by tag fields to narrow results.
 *
 * Use tag_1 through tag_12 for filtering - these are generic indexed fields you define:
 * - Legal app: tag_1=client_id, tag_2=matter_id
 * - Healthcare: tag_1=patient_id, tag_2=encounter_id
 *
 * @see Router\Services\Memory\V1Service::search()
 *
 * @phpstan-type V1SearchParamsShape = array{
 *   query: string,
 *   category?: string|null,
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
 *   topK?: int|null,
 * }
 */
final class V1SearchParams implements BaseModel
{
    /** @use SdkModel<V1SearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query for semantic matching.
     */
    #[Required]
    public string $query;

    /**
     * Filter by category.
     */
    #[Optional]
    public ?string $category;

    /**
     * Filter by tag_1.
     */
    #[Optional('tag_1')]
    public ?string $tag1;

    /**
     * Filter by tag_10.
     */
    #[Optional('tag_10')]
    public ?string $tag10;

    /**
     * Filter by tag_11.
     */
    #[Optional('tag_11')]
    public ?string $tag11;

    /**
     * Filter by tag_12.
     */
    #[Optional('tag_12')]
    public ?string $tag12;

    /**
     * Filter by tag_2.
     */
    #[Optional('tag_2')]
    public ?string $tag2;

    /**
     * Filter by tag_3.
     */
    #[Optional('tag_3')]
    public ?string $tag3;

    /**
     * Filter by tag_4.
     */
    #[Optional('tag_4')]
    public ?string $tag4;

    /**
     * Filter by tag_5.
     */
    #[Optional('tag_5')]
    public ?string $tag5;

    /**
     * Filter by tag_6.
     */
    #[Optional('tag_6')]
    public ?string $tag6;

    /**
     * Filter by tag_7.
     */
    #[Optional('tag_7')]
    public ?string $tag7;

    /**
     * Filter by tag_8.
     */
    #[Optional('tag_8')]
    public ?string $tag8;

    /**
     * Filter by tag_9.
     */
    #[Optional('tag_9')]
    public ?string $tag9;

    /**
     * Maximum number of results to return.
     */
    #[Optional('top_k')]
    public ?int $topK;

    /**
     * `new V1SearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1SearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1SearchParams)->withQuery(...)
     * ```
     */
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
        string $query,
        ?string $category = null,
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
        ?int $topK = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $category && $self['category'] = $category;
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
        null !== $topK && $self['topK'] = $topK;

        return $self;
    }

    /**
     * Search query for semantic matching.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Filter by category.
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

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

    /**
     * Maximum number of results to return.
     */
    public function withTopK(int $topK): self
    {
        $self = clone $this;
        $self['topK'] = $topK;

        return $self;
    }
}
