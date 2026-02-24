<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Secrets;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a new secret group in a compute environment. Secret groups organize related secrets for use in serverless functions and workflows. If no environment is specified, the group is created in the default environment.
 *
 * **Features:**
 * - Organize secrets by logical groups (e.g., database, APIs, third-party services)
 * - Environment-based isolation
 * - Validation of group names
 * - Conflict detection for existing groups
 *
 * @see CaseDev\Services\Compute\V1\SecretsService::create()
 *
 * @phpstan-type SecretCreateParamsShape = array{
 *   name: string, description?: string|null, env?: string|null
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
    #[Required]
    public string $name;

    /**
     * Optional description of the secret group's purpose.
     */
    #[Optional]
    public ?string $description;

    /**
     * Environment name where the secret group will be created. Uses default environment if not specified.
     */
    #[Optional]
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
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $env && $self['env'] = $env;

        return $self;
    }

    /**
     * Unique name for the secret group. Must contain only letters, numbers, hyphens, and underscores.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description of the secret group's purpose.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Environment name where the secret group will be created. Uses default environment if not specified.
     */
    public function withEnv(string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }
}
