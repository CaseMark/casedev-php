<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Memory\MemoryNewResponse\Entry;

/**
 * @phpstan-import-type EntryShape from \CaseDev\Vault\Memory\MemoryNewResponse\Entry
 *
 * @phpstan-type MemoryNewResponseShape = array{entry?: null|Entry|EntryShape}
 */
final class MemoryNewResponse implements BaseModel
{
    /** @use SdkModel<MemoryNewResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Entry $entry;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Entry|EntryShape|null $entry
     */
    public static function with(Entry|array|null $entry = null): self
    {
        $self = new self;

        null !== $entry && $self['entry'] = $entry;

        return $self;
    }

    /**
     * @param Entry|EntryShape $entry
     */
    public function withEntry(Entry|array $entry): self
    {
        $self = clone $this;
        $self['entry'] = $entry;

        return $self;
    }
}
