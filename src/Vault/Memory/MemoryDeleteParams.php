<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Remove a file-backed memory entry from a vault.
 *
 * @see CaseDev\Services\Vault\MemoryService::delete()
 *
 * @phpstan-type MemoryDeleteParamsShape = array{id: string}
 */
final class MemoryDeleteParams implements BaseModel
{
    /** @use SdkModel<MemoryDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new MemoryDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MemoryDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MemoryDeleteParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
