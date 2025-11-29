<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Set or update secrets in a compute secret group. Secrets are encrypted with AES-256-GCM and synced to compute infrastructure in real-time. Use this to manage environment variables and API keys for your compute workloads.
 *
 * @see Casedev\Services\Compute\V1\SecretsService::updateGroup()
 *
 * @phpstan-type SecretUpdateGroupParamsShape = array{
 *   secrets: array<string,string>, env?: string
 * }
 */
final class SecretUpdateGroupParams implements BaseModel
{
    /** @use SdkModel<SecretUpdateGroupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Key-value pairs of secrets to set.
     *
     * @var array<string,string> $secrets
     */
    #[Api(map: 'string')]
    public array $secrets;

    /**
     * Environment name (optional, uses default if not specified).
     */
    #[Api(optional: true)]
    public ?string $env;

    /**
     * `new SecretUpdateGroupParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SecretUpdateGroupParams::with(secrets: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SecretUpdateGroupParams)->withSecrets(...)
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
     * @param array<string,string> $secrets
     */
    public static function with(array $secrets, ?string $env = null): self
    {
        $obj = new self;

        $obj->secrets = $secrets;

        null !== $env && $obj->env = $env;

        return $obj;
    }

    /**
     * Key-value pairs of secrets to set.
     *
     * @param array<string,string> $secrets
     */
    public function withSecrets(array $secrets): self
    {
        $obj = clone $this;
        $obj->secrets = $secrets;

        return $obj;
    }

    /**
     * Environment name (optional, uses default if not specified).
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj->env = $env;

        return $obj;
    }
}
