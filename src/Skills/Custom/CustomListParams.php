<?php

declare(strict_types=1);

namespace CaseDev\Skills\Custom;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * List all custom skills for the authenticated organization. Supports cursor-based pagination.
 *
 * @see CaseDev\Services\Skills\CustomService::list()
 *
 * @phpstan-type CustomListParamsShape = array{
 *   cursor?: string|null, limit?: int|null, tag?: string|null
 * }
 */
final class CustomListParams implements BaseModel
{
    /** @use SdkModel<CustomListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor for pagination (skill ID from previous page).
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of results (1-100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by tag.
     */
    #[Optional]
    public ?string $tag;

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
        ?string $cursor = null,
        ?int $limit = null,
        ?string $tag = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $tag && $self['tag'] = $tag;

        return $self;
    }

    /**
     * Cursor for pagination (skill ID from previous page).
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of results (1-100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by tag.
     */
    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }
}
