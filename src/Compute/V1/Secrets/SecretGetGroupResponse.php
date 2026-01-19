<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Compute\V1\Secrets\SecretGetGroupResponse\Group;
use Casedev\Compute\V1\Secrets\SecretGetGroupResponse\Key;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type GroupShape from \Casedev\Compute\V1\Secrets\SecretGetGroupResponse\Group
 * @phpstan-import-type KeyShape from \Casedev\Compute\V1\Secrets\SecretGetGroupResponse\Key
 *
 * @phpstan-type SecretGetGroupResponseShape = array{
 *   group?: null|Group|GroupShape, keys?: list<Key|KeyShape>|null
 * }
 */
final class SecretGetGroupResponse implements BaseModel
{
    /** @use SdkModel<SecretGetGroupResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Group $group;

    /** @var list<Key>|null $keys */
    #[Optional(list: Key::class)]
    public ?array $keys;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Group|GroupShape|null $group
     * @param list<Key|KeyShape>|null $keys
     */
    public static function with(
        Group|array|null $group = null,
        ?array $keys = null
    ): self {
        $self = new self;

        null !== $group && $self['group'] = $group;
        null !== $keys && $self['keys'] = $keys;

        return $self;
    }

    /**
     * @param Group|GroupShape $group
     */
    public function withGroup(Group|array $group): self
    {
        $self = clone $this;
        $self['group'] = $group;

        return $self;
    }

    /**
     * @param list<Key|KeyShape> $keys
     */
    public function withKeys(array $keys): self
    {
        $self = clone $this;
        $self['keys'] = $keys;

        return $self;
    }
}
