<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments;

use Casedev\Compute\V1\Environments\EnvironmentListResponse\Environment;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type EnvironmentShape from \Casedev\Compute\V1\Environments\EnvironmentListResponse\Environment
 *
 * @phpstan-type EnvironmentListResponseShape = array{
 *   environments?: list<Environment|EnvironmentShape>|null
 * }
 */
final class EnvironmentListResponse implements BaseModel
{
    /** @use SdkModel<EnvironmentListResponseShape> */
    use SdkModel;

    /** @var list<Environment>|null $environments */
    #[Optional(list: Environment::class)]
    public ?array $environments;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Environment|EnvironmentShape>|null $environments
     */
    public static function with(?array $environments = null): self
    {
        $self = new self;

        null !== $environments && $self['environments'] = $environments;

        return $self;
    }

    /**
     * @param list<Environment|EnvironmentShape> $environments
     */
    public function withEnvironments(array $environments): self
    {
        $self = clone $this;
        $self['environments'] = $environments;

        return $self;
    }
}
