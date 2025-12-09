<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve the keys (names) of secrets in a specified group within a compute environment. For security reasons, actual secret values are not returned - only the keys and metadata.
 *
 * @see Casedev\Services\Compute\V1\SecretsService::retrieveGroup()
 *
 * @phpstan-type SecretRetrieveGroupParamsShape = array{env?: string}
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
        $obj = new self;

        null !== $env && $obj['env'] = $env;

        return $obj;
    }

    /**
     * Environment name. If not specified, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj['env'] = $env;

        return $obj;
    }
}
