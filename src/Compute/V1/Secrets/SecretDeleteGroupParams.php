<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Delete an entire secret group or a specific key within a secret group. Automatically syncs the deletion to Modal compute infrastructure. When deleting a specific key, the remaining secrets in the group are re-synced. When deleting the entire group, all secrets and the group itself are removed from both the database and Modal.
 *
 * @see Casedev\Services\Compute\V1\SecretsService::deleteGroup()
 *
 * @phpstan-type SecretDeleteGroupParamsShape = array{env?: string, key?: string}
 */
final class SecretDeleteGroupParams implements BaseModel
{
    /** @use SdkModel<SecretDeleteGroupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name. If not provided, uses the default environment.
     */
    #[Api(optional: true)]
    public ?string $env;

    /**
     * Specific key to delete within the group. If not provided, the entire group is deleted.
     */
    #[Api(optional: true)]
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
        $obj = new self;

        null !== $env && $obj['env'] = $env;
        null !== $key && $obj['key'] = $key;

        return $obj;
    }

    /**
     * Environment name. If not provided, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj['env'] = $env;

        return $obj;
    }

    /**
     * Specific key to delete within the group. If not provided, the entire group is deleted.
     */
    public function withKey(string $key): self
    {
        $obj = clone $this;
        $obj['key'] = $key;

        return $obj;
    }
}
