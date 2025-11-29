<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Creates a new compute environment for running serverless workloads. Each environment gets its own isolated namespace with a unique domain for hosting applications and APIs. The first environment created becomes the default environment for the organization.
 *
 * @see Casedev\Services\Compute\V1\EnvironmentsService::create()
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
    #[Api]
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
        $obj = new self;

        $obj->name = $name;

        return $obj;
    }

    /**
     * Environment name (alphanumeric, hyphens, and underscores only).
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
