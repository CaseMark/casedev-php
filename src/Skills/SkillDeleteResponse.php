<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SkillDeleteResponseShape = array{
 *   deleted?: bool|null, slug?: string|null
 * }
 */
final class SkillDeleteResponse implements BaseModel
{
    /** @use SdkModel<SkillDeleteResponseShape> */
    use SdkModel;

    #[Optional]
    public ?bool $deleted;

    #[Optional]
    public ?string $slug;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $deleted = null, ?string $slug = null): self
    {
        $self = new self;

        null !== $deleted && $self['deleted'] = $deleted;
        null !== $slug && $self['slug'] = $slug;

        return $self;
    }

    public function withDeleted(bool $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }

    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }
}
