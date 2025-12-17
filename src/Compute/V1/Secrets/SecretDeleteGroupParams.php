<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Delete an entire secret group or a specific key within a secret group. When deleting a specific key, the remaining secrets in the group are preserved. When deleting the entire group, all secrets and the group itself are removed.
 *
 * @see Casedev\Services\Compute\V1\SecretsService::deleteGroup()
 *
 * @phpstan-type SecretDeleteGroupParamsShape = array{
 *   env?: string|null, key?: string|null
 * }
 */
final class SecretDeleteGroupParams implements BaseModel
{
    /** @use SdkModel<SecretDeleteGroupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name. If not provided, uses the default environment.
     */
    #[Optional]
    public ?string $env;

    /**
     * Specific key to delete within the group. If not provided, the entire group is deleted.
     */
    #[Optional]
    public ?string $key;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $env = null, ?string $key = null): self
    {
        $self = new self;

        null !== $env && $self['env'] = $env;
        null !== $key && $self['key'] = $key;

        return $self;
    }

    /**
     * Environment name. If not provided, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }

    /**
     * Specific key to delete within the group. If not provided, the entire group is deleted.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }
}
