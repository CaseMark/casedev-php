<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat\Files\FileListResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{
 *   name?: string|null, path?: string|null, sizeBytes?: int|null
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    #[Optional]
    public ?string $name;

    /**
     * Relative path from /workspace.
     */
    #[Optional]
    public ?string $path;

    #[Optional]
    public ?int $sizeBytes;

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
        ?string $name = null,
        ?string $path = null,
        ?int $sizeBytes = null
    ): self {
        $self = new self;

        null !== $name && $self['name'] = $name;
        null !== $path && $self['path'] = $path;
        null !== $sizeBytes && $self['sizeBytes'] = $sizeBytes;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Relative path from /workspace.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    public function withSizeBytes(int $sizeBytes): self
    {
        $self = clone $this;
        $self['sizeBytes'] = $sizeBytes;

        return $self;
    }
}
