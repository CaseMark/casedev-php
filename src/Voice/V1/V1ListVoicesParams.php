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
 *   category?: string|null,
 *   collectionID?: string|null,
 *   includeTotalCount?: bool|null,
 *   nextPageToken?: string|null,
 *   pageSize?: int|null,
 *   search?: string|null,
 *   sort?: null|Sort|value-of<Sort>,
 *   sortDirection?: null|SortDirection|value-of<SortDirection>,
 *   voiceType?: null|VoiceType|value-of<VoiceType>,
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
    public ?string $collectionID;

    /**
     * Whether to include total count in response.
     */
    #[Optional]
    public ?bool $includeTotalCount;

    /**
     * Token for retrieving the next page of results.
     */
    #[Optional]
    public ?string $nextPageToken;

    /**
     * Number of voices to return per page (max 100).
     */
    #[Optional]
    public ?int $pageSize;

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
     * @var value-of<SortDirection>|null $sortDirection
     */
    #[Optional(enum: SortDirection::class)]
    public ?string $sortDirection;

    /**
     * Filter by voice type.
     *
     * @var value-of<VoiceType>|null $voiceType
     */
    #[Optional(enum: VoiceType::class)]
    public ?string $voiceType;

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
     * @param SortDirection|value-of<SortDirection> $sortDirection
     * @param VoiceType|value-of<VoiceType> $voiceType
     */
    public static function with(
        ?string $category = null,
        ?string $collectionID = null,
        ?bool $includeTotalCount = null,
        ?string $nextPageToken = null,
        ?int $pageSize = null,
        ?string $search = null,
        Sort|string|null $sort = null,
        SortDirection|string|null $sortDirection = null,
        VoiceType|string|null $voiceType = null,
    ): self {
        $self = new self;

        null !== $category && $self['category'] = $category;
        null !== $collectionID && $self['collectionID'] = $collectionID;
        null !== $includeTotalCount && $self['includeTotalCount'] = $includeTotalCount;
        null !== $nextPageToken && $self['nextPageToken'] = $nextPageToken;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $search && $self['search'] = $search;
        null !== $sort && $self['sort'] = $sort;
        null !== $sortDirection && $self['sortDirection'] = $sortDirection;
        null !== $voiceType && $self['voiceType'] = $voiceType;

        return $self;
    }

    /**
     * Filter by voice category.
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Filter by voice collection ID.
     */
    public function withCollectionID(string $collectionID): self
    {
        $self = clone $this;
        $self['collectionID'] = $collectionID;

        return $self;
    }

    /**
     * Whether to include total count in response.
     */
    public function withIncludeTotalCount(bool $includeTotalCount): self
    {
        $self = clone $this;
        $self['includeTotalCount'] = $includeTotalCount;

        return $self;
    }

    /**
     * Token for retrieving the next page of results.
     */
    public function withNextPageToken(string $nextPageToken): self
    {
        $self = clone $this;
        $self['nextPageToken'] = $nextPageToken;

        return $self;
    }

    /**
     * Number of voices to return per page (max 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Search term to filter voices by name or description.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Field to sort by.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }

    /**
     * Sort direction.
     *
     * @param SortDirection|value-of<SortDirection> $sortDirection
     */
    public function withSortDirection(SortDirection|string $sortDirection): self
    {
        $self = clone $this;
        $self['sortDirection'] = $sortDirection;

        return $self;
    }

    /**
     * Filter by voice type.
     *
     * @param VoiceType|value-of<VoiceType> $voiceType
     */
    public function withVoiceType(VoiceType|string $voiceType): self
    {
        $self = clone $this;
        $self['voiceType'] = $voiceType;

        return $self;
    }
}
