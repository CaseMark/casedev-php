<?php

declare(strict_types=1);

namespace Router\Compute\V1\Secrets;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Retrieve the keys (names) of secrets in a specified group within a compute environment. For security reasons, actual secret values are not returned - only the keys and metadata.
 *
 * @see Router\Services\Compute\V1\SecretsService::retrieveGroup()
 *
 * @phpstan-type SecretRetrieveGroupParamsShape = array{env?: string|null}
 */
final class SecretRetrieveGroupParams implements BaseModel
{
    /** @use SdkModel<SecretRetrieveGroupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name. If not specified, uses the default environment.
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
     * Environment name. If not specified, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }
}
