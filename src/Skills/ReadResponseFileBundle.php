<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Skills\ReadResponseFileBundle\Role;

/**
 * @phpstan-type ReadResponseFileBundleShape = array{
 *   path: string,
 *   role: Role|value-of<Role>,
 *   rootSlug: string,
 *   contentType?: string|null,
 * }
 */
final class ReadResponseFileBundle implements BaseModel
{
    /** @use SdkModel<ReadResponseFileBundleShape> */
    use SdkModel;

    #[Required]
    public string $path;

    /** @var value-of<Role> $role */
    #[Required(enum: Role::class)]
    public string $role;

    #[Required('root_slug')]
    public string $rootSlug;

    #[Optional('content_type', nullable: true)]
    public ?string $contentType;

    /**
     * `new ReadResponseFileBundle()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReadResponseFileBundle::with(path: ..., role: ..., rootSlug: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReadResponseFileBundle)->withPath(...)->withRole(...)->withRootSlug(...)
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
     * @param Role|value-of<Role> $role
     */
    public static function with(
        string $path,
        Role|string $role,
        string $rootSlug,
        ?string $contentType = null,
    ): self {
        $self = new self;

        $self['path'] = $path;
        $self['role'] = $role;
        $self['rootSlug'] = $rootSlug;

        null !== $contentType && $self['contentType'] = $contentType;

        return $self;
    }

    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * @param Role|value-of<Role> $role
     */
    public function withRole(Role|string $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

        return $self;
    }

    public function withRootSlug(string $rootSlug): self
    {
        $self = clone $this;
        $self['rootSlug'] = $rootSlug;

        return $self;
    }

    public function withContentType(?string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }
}
