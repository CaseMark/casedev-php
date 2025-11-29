<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Retrieve all secret groups for a compute environment. Secret groups organize related secrets (API keys, credentials, etc.) that can be securely accessed by compute jobs during execution.
 *
 * @see Casedev\Services\Compute\V1\SecretsService::list()
 *
 * @phpstan-type SecretListParamsShape = array{env?: string}
 */
final class SecretListParams implements BaseModel
{
    /** @use SdkModel<SecretListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name to list secret groups for. If not specified, uses the default environment.
     */
    #[Api(optional: true)]
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

        null !== $env && $obj->env = $env;

        return $obj;
    }

    /**
     * Environment name to list secret groups for. If not specified, uses the default environment.
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj->env = $env;

        return $obj;
    }
}
