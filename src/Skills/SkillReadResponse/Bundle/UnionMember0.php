<?php

declare(strict_types=1);

namespace CaseDev\Skills\SkillReadResponse\Bundle;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0\File;
use CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0\Role;

/**
 * @phpstan-import-type FileShape from \CaseDev\Skills\SkillReadResponse\Bundle\UnionMember0\File
 *
 * @phpstan-type UnionMember0Shape = array{
 *   files: list<File|FileShape>, role: Role|value-of<Role>
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    /** @var list<File> $files */
    #[Required(list: File::class)]
    public array $files;

    /** @var value-of<Role> $role */
    #[Required(enum: Role::class)]
    public string $role;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(files: ..., role: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withFiles(...)->withRole(...)
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
     * @param list<File|FileShape> $files
     * @param Role|value-of<Role> $role
     */
    public static function with(array $files, Role|string $role): self
    {
        $self = new self;

        $self['files'] = $files;
        $self['role'] = $role;

        return $self;
    }

    /**
     * @param list<File|FileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

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
}
