<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * List all environment variables for a project (values are hidden unless decrypt=true).
 *
 * @see Router\Services\Applications\V1\ProjectsService::listEnv()
 *
 * @phpstan-type ProjectListEnvParamsShape = array{decrypt?: bool|null}
 */
final class ProjectListEnvParams implements BaseModel
{
    /** @use SdkModel<ProjectListEnvParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Whether to decrypt and return values (requires appropriate permissions).
     */
    #[Optional]
    public ?bool $decrypt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $decrypt = null): self
    {
        $self = new self;

        null !== $decrypt && $self['decrypt'] = $decrypt;

        return $self;
    }

    /**
     * Whether to decrypt and return values (requires appropriate permissions).
     */
    public function withDecrypt(bool $decrypt): self
    {
        $self = clone $this;
        $self['decrypt'] = $decrypt;

        return $self;
    }
}
