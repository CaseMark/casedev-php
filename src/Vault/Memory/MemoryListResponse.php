<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Memory\MemoryListResponse\Entry;
use CaseDev\Vault\Memory\MemoryListResponse\Meta;

/**
 * @phpstan-import-type EntryShape from \CaseDev\Vault\Memory\MemoryListResponse\Entry
 * @phpstan-import-type MetaShape from \CaseDev\Vault\Memory\MemoryListResponse\Meta
 *
 * @phpstan-type MemoryListResponseShape = array{
 *   entries?: list<Entry|EntryShape>|null, meta?: null|Meta|MetaShape
 * }
 */
final class MemoryListResponse implements BaseModel
{
    /** @use SdkModel<MemoryListResponseShape> */
    use SdkModel;

    /** @var list<Entry>|null $entries */
    #[Optional(list: Entry::class)]
    public ?array $entries;

    #[Optional]
    public ?Meta $meta;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Entry|EntryShape>|null $entries
     * @param Meta|MetaShape|null $meta
     */
    public static function with(
        ?array $entries = null,
        Meta|array|null $meta = null
    ): self {
        $self = new self;

        null !== $entries && $self['entries'] = $entries;
        null !== $meta && $self['meta'] = $meta;

        return $self;
    }

    /**
     * @param list<Entry|EntryShape> $entries
     */
    public function withEntries(array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }

    /**
     * @param Meta|MetaShape $meta
     */
    public function withMeta(Meta|array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }
}
