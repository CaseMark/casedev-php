<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{
 *   path: string, slug: string, contentType?: string|null, name?: string|null
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    #[Required]
    public string $path;

    #[Required]
    public string $slug;

    #[Optional('content_type', nullable: true)]
    public ?string $contentType;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(path: ..., slug: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new File)->withPath(...)->withSlug(...)
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
        string $path,
        string $slug,
        ?string $contentType = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['path'] = $path;
        $self['slug'] = $slug;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    public function withContentType(?string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
