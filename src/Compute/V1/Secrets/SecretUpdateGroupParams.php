<?php

declare(strict_types=1);

namespace Router\Compute\V1\Secrets;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Set or update secrets in a compute secret group. Secrets are encrypted with AES-256-GCM. Use this to manage environment variables and API keys for your compute workloads.
 *
 * @see Router\Services\Compute\V1\SecretsService::updateGroup()
 *
 * @phpstan-type SecretUpdateGroupParamsShape = array{
 *   secrets: array<string,string>, env?: string|null
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
    #[Required(map: 'string')]
    public array $secrets;

    /**
     * Environment name (optional, uses default if not specified).
     */
    #[Optional]
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
        $self = new self;

        $self['secrets'] = $secrets;

        null !== $env && $self['env'] = $env;

        return $self;
    }

    /**
     * Key-value pairs of secrets to set.
     *
     * @param array<string,string> $secrets
     */
    public function withSecrets(array $secrets): self
    {
        $self = clone $this;
        $self['secrets'] = $secrets;

        return $self;
    }

    /**
     * Environment name (optional, uses default if not specified).
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }
}
