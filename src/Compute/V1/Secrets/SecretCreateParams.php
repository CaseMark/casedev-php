<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Secrets;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates a new secret group in a compute environment. Secret groups organize related secrets for use in serverless functions and workflows. If no environment is specified, the group is created in the default environment.
 *
 * **Features:**
 * - Organize secrets by logical groups (e.g., database, APIs, third-party services)
 * - Environment-based isolation
 * - Validation of group names
 * - Conflict detection for existing groups
 *
 * @see Casedev\Services\Compute\V1\SecretsService::create()
 *
 * @phpstan-type SecretCreateParamsShape = array{
 *   name: string, description?: string, env?: string
 * }
 */
final class SecretCreateParams implements BaseModel
{
    /** @use SdkModel<SecretCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Unique name for the secret group. Must contain only letters, numbers, hyphens, and underscores.
     */
    #[Api]
    public string $name;

    /**
     * Optional description of the secret group's purpose.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Environment name where the secret group will be created. Uses default environment if not specified.
     */
    #[Api(optional: true)]
    public ?string $env;

    /**
     * `new SecretCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SecretCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SecretCreateParams)->withName(...)
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
     */
    public static function with(
        string $name,
        ?string $description = null,
        ?string $env = null
    ): self {
        $obj = new self;

        $obj['name'] = $name;

        null !== $description && $obj['description'] = $description;
        null !== $env && $obj['env'] = $env;

        return $obj;
    }

    /**
     * Unique name for the secret group. Must contain only letters, numbers, hyphens, and underscores.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Optional description of the secret group's purpose.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Environment name where the secret group will be created. Uses default environment if not specified.
     */
    public function withEnv(string $env): self
    {
        $obj = clone $this;
        $obj['env'] = $env;

        return $obj;
    }
}
