<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Secrets;

use CaseDev\Compute\V1\Secrets\SecretListResponse\Group;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type GroupShape from \CaseDev\Compute\V1\Secrets\SecretListResponse\Group
 *
 * @phpstan-type SecretListResponseShape = array{
 *   groups?: list<Group|GroupShape>|null
 * }
 */
final class SecretListResponse implements BaseModel
{
    /** @use SdkModel<SecretListResponseShape> */
    use SdkModel;

    /** @var list<Group>|null $groups */
    #[Optional(list: Group::class)]
    public ?array $groups;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Group|GroupShape>|null $groups
     */
    public static function with(?array $groups = null): self
    {
        $self = new self;

        null !== $groups && $self['groups'] = $groups;

        return $self;
    }

    /**
     * @param list<Group|GroupShape> $groups
     */
    public function withGroups(array $groups): self
    {
        $self = clone $this;
        $self['groups'] = $groups;

        return $self;
    }
}
