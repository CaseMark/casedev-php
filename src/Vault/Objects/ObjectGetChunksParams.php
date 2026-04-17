<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Retrieves full extracted chunk text for a processed vault object. Use this after search when a truncated preview is not enough and you need the exact chunk text or adjacent chunks for surrounding context such as tables, exhibit lists, or multi-part passages.
 *
 * @see CaseDev\Services\Vault\ObjectsService::getChunks()
 *
 * @phpstan-type ObjectGetChunksParamsShape = array{
 *   id: string, end?: int|null, start?: int|null
 * }
 */
final class ObjectGetChunksParams implements BaseModel
{
    /** @use SdkModel<ObjectGetChunksParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * The last chunk index to return (inclusive). If omitted, only the `start` chunk is returned. Ranges are limited to 10 chunks.
     */
    #[Optional]
    public ?int $end;

    /**
     * The first chunk index to return (0-based). Defaults to 0.
     */
    #[Optional]
    public ?int $start;

    /**
     * `new ObjectGetChunksParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetChunksParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetChunksParams)->withID(...)
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
        string $id,
        ?int $end = null,
        ?int $start = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The last chunk index to return (inclusive). If omitted, only the `start` chunk is returned. Ranges are limited to 10 chunks.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * The first chunk index to return (0-based). Defaults to 0.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
