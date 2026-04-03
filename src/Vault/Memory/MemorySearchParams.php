<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Search file-backed vault memory using simple full-text matching over content and tags.
 *
 * @see CaseDev\Services\Vault\MemoryService::search()
 *
 * @phpstan-type MemorySearchParamsShape = array{
 *   query: string,
 *   limit?: int|null,
 *   tags?: list<string>|null,
 *   types?: list<string>|null,
 * }
 */
final class MemorySearchParams implements BaseModel
{
    /** @use SdkModel<MemorySearchParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $query;

    #[Optional]
    public ?int $limit;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    /** @var list<string>|null $types */
    #[Optional(list: 'string')]
    public ?array $types;

    /**
     * `new MemorySearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MemorySearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MemorySearchParams)->withQuery(...)
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
     *
     * @param list<string>|null $tags
     * @param list<string>|null $types
     */
    public static function with(
        string $query,
        ?int $limit = null,
        ?array $tags = null,
        ?array $types = null
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $limit && $self['limit'] = $limit;
        null !== $tags && $self['tags'] = $tags;
        null !== $types && $self['types'] = $types;

        return $self;
    }

    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * @param list<string> $types
     */
    public function withTypes(array $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }
}
