<?php

declare(strict_types=1);

namespace CaseDev\Compute\V1\Environments;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a new compute environment for running serverless workloads. Each environment gets its own isolated namespace with a unique domain for hosting applications and APIs. The first environment created becomes the default environment for the organization.
 *
 * @see CaseDev\Services\Compute\V1\EnvironmentsService::create()
 *
 * @phpstan-type EnvironmentCreateParamsShape = array{name: string}
 */
final class EnvironmentCreateParams implements BaseModel
{
    /** @use SdkModel<EnvironmentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment name (alphanumeric, hyphens, and underscores only).
     */
    #[Required]
    public string $name;

    /**
     * `new EnvironmentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EnvironmentCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EnvironmentCreateParams)->withName(...)
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
    public static function with(string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * Environment name (alphanumeric, hyphens, and underscores only).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
