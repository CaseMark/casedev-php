<?php

declare(strict_types=1);

namespace Casedev\Voice\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\V1\V1ListVoicesParams\Sort;
use Casedev\Voice\V1\V1ListVoicesParams\SortDirection;
use Casedev\Voice\V1\V1ListVoicesParams\VoiceType;

/**
 * Retrieve a list of available voices for text-to-speech synthesis. This endpoint provides access to a comprehensive catalog of voices with various characteristics, languages, and styles suitable for legal document narration, client presentations, and accessibility purposes.
 *
 * @see Casedev\Services\Voice\V1Service::listVoices()
 *
 * @phpstan-type V1ListVoicesParamsShape = array{
 *   category?: string,
 *   collection_id?: string,
 *   include_total_count?: bool,
 *   next_page_token?: string,
 *   page_size?: int,
 *   search?: string,
 *   sort?: Sort|value-of<Sort>,
 *   sort_direction?: SortDirection|value-of<SortDirection>,
 *   voice_type?: VoiceType|value-of<VoiceType>,
 * }
 */
final class V1ListVoicesParams implements BaseModel
{
    /** @use SdkModel<V1ListVoicesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by voice category.
     */
    #[Optional]
    public ?string $category;

    /**
     * Filter by voice collection ID.
     */
    #[Optional]
    public ?string $collection_id;

    /**
     * Whether to include total count in response.
     */
    #[Optional]
    public ?bool $include_total_count;

    /**
     * Token for retrieving the next page of results.
     */
    #[Optional]
    public ?string $next_page_token;

    /**
     * Number of voices to return per page (max 100).
     */
    #[Optional]
    public ?int $page_size;

    /**
     * Search term to filter voices by name or description.
     */
    #[Optional]
    public ?string $search;

    /**
     * Field to sort by.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * Sort direction.
     *
     * @var value-of<SortDirection>|null $sort_direction
     */
    #[Optional(enum: SortDirection::class)]
    public ?string $sort_direction;

    /**
     * Filter by voice type.
     *
     * @var value-of<VoiceType>|null $voice_type
     */
    #[Optional(enum: VoiceType::class)]
    public ?string $voice_type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Sort|value-of<Sort> $sort
     * @param SortDirection|value-of<SortDirection> $sort_direction
     * @param VoiceType|value-of<VoiceType> $voice_type
     */
    public static function with(
        ?string $category = null,
        ?string $collection_id = null,
        ?bool $include_total_count = null,
        ?string $next_page_token = null,
        ?int $page_size = null,
        ?string $search = null,
        Sort|string|null $sort = null,
        SortDirection|string|null $sort_direction = null,
        VoiceType|string|null $voice_type = null,
    ): self {
        $obj = new self;

        null !== $category && $obj['category'] = $category;
        null !== $collection_id && $obj['collection_id'] = $collection_id;
        null !== $include_total_count && $obj['include_total_count'] = $include_total_count;
        null !== $next_page_token && $obj['next_page_token'] = $next_page_token;
        null !== $page_size && $obj['page_size'] = $page_size;
        null !== $search && $obj['search'] = $search;
        null !== $sort && $obj['sort'] = $sort;
        null !== $sort_direction && $obj['sort_direction'] = $sort_direction;
        null !== $voice_type && $obj['voice_type'] = $voice_type;

        return $obj;
    }

    /**
     * Filter by voice category.
     */
    public function withCategory(string $category): self
    {
        $obj = clone $this;
        $obj['category'] = $category;

        return $obj;
    }

    /**
     * Filter by voice collection ID.
     */
    public function withCollectionID(string $collectionID): self
    {
        $obj = clone $this;
        $obj['collection_id'] = $collectionID;

        return $obj;
    }

    /**
     * Whether to include total count in response.
     */
    public function withIncludeTotalCount(bool $includeTotalCount): self
    {
        $obj = clone $this;
        $obj['include_total_count'] = $includeTotalCount;

        return $obj;
    }

    /**
     * Token for retrieving the next page of results.
     */
    public function withNextPageToken(string $nextPageToken): self
    {
        $obj = clone $this;
        $obj['next_page_token'] = $nextPageToken;

        return $obj;
    }

    /**
     * Number of voices to return per page (max 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
    }

    /**
     * Search term to filter voices by name or description.
     */
    public function withSearch(string $search): self
    {
        $obj = clone $this;
        $obj['search'] = $search;

        return $obj;
    }

    /**
     * Field to sort by.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $obj = clone $this;
        $obj['sort'] = $sort;

        return $obj;
    }

    /**
     * Sort direction.
     *
     * @param SortDirection|value-of<SortDirection> $sortDirection
     */
    public function withSortDirection(SortDirection|string $sortDirection): self
    {
        $obj = clone $this;
        $obj['sort_direction'] = $sortDirection;

        return $obj;
    }

    /**
     * Filter by voice type.
     *
     * @param VoiceType|value-of<VoiceType> $voiceType
     */
    public function withVoiceType(VoiceType|string $voiceType): self
    {
        $obj = clone $this;
        $obj['voice_type'] = $voiceType;

        return $obj;
    }
}
