<?php

declare(strict_types=1);

namespace Router\Compute\V1\Secrets;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieve all secret groups for a compute environment. Secret groups organize related secrets (API keys, credentials, etc.) that can be securely accessed by compute jobs during execution.
 *
 * @see Router\Services\Compute\V1\SecretsService::list()
 *
 * @phpstan-type SecretListParamsShape = array{env?: string|null}
 */
final class SecretListParams implements BaseModel
{
    /** @use SdkModel<SecretListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name to list secret groups for. If not specified, uses the default environment.
     */
    #[Optional]
    public ?string $env;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $env = null): self
    {
        $self = new self;

        null !== $env && $self['env'] = $env;

        return $self;
    }

    /**
     * Environment name to list secret groups for. If not specified, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }
}
