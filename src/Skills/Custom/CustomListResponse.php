<?php

declare(strict_types=1);

namespace CaseDev\Skills\Custom;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Skills\Custom\CustomListResponse\Skill;

/**
 * @phpstan-import-type SkillShape from \CaseDev\Skills\Custom\CustomListResponse\Skill
 *
 * @phpstan-type CustomListResponseShape = array{
 *   hasMore?: bool|null,
 *   nextCursor?: string|null,
 *   skills?: list<Skill|SkillShape>|null,
 * }
 */
final class CustomListResponse implements BaseModel
{
    /** @use SdkModel<CustomListResponseShape> */
    use SdkModel;

    #[Optional('has_more')]
    public ?bool $hasMore;

    #[Optional('next_cursor', nullable: true)]
    public ?string $nextCursor;

    /** @var list<Skill>|null $skills */
    #[Optional(list: Skill::class)]
    public ?array $skills;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Skill|SkillShape>|null $skills
     */
    public static function with(
        ?bool $hasMore = null,
        ?string $nextCursor = null,
        ?array $skills = null
    ): self {
        $self = new self;

        null !== $hasMore && $self['hasMore'] = $hasMore;
        null !== $nextCursor && $self['nextCursor'] = $nextCursor;
        null !== $skills && $self['skills'] = $skills;

        return $self;
    }

    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Skill|SkillShape> $skills
     */
    public function withSkills(array $skills): self
    {
        $self = clone $this;
        $self['skills'] = $skills;

        return $self;
    }
}
