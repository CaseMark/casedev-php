<?php

declare(strict_types=1);

namespace Casedev\Projects\V1\V1DeleteResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResourcesDeletedShape = array{
 *   bundles?: float|null,
 *   codeBuild?: float|null,
 *   routingEntries?: float|null,
 *   s3Sources?: float|null,
 * }
 */
final class ResourcesDeleted implements BaseModel
{
    /** @use SdkModel<ResourcesDeletedShape> */
    use SdkModel;

    #[Optional]
    public ?float $bundles;

    #[Optional]
    public ?float $codeBuild;

    #[Optional]
    public ?float $routingEntries;

    #[Optional]
    public ?float $s3Sources;

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
        ?float $bundles = null,
        ?float $codeBuild = null,
        ?float $routingEntries = null,
        ?float $s3Sources = null,
    ): self {
        $self = new self;

        null !== $bundles && $self['bundles'] = $bundles;
        null !== $codeBuild && $self['codeBuild'] = $codeBuild;
        null !== $routingEntries && $self['routingEntries'] = $routingEntries;
        null !== $s3Sources && $self['s3Sources'] = $s3Sources;

        return $self;
    }

    public function withBundles(float $bundles): self
    {
        $self = clone $this;
        $self['bundles'] = $bundles;

        return $self;
    }

    public function withCodeBuild(float $codeBuild): self
    {
        $self = clone $this;
        $self['codeBuild'] = $codeBuild;

        return $self;
    }

    public function withRoutingEntries(float $routingEntries): self
    {
        $self = clone $this;
        $self['routingEntries'] = $routingEntries;

        return $self;
    }

    public function withS3Sources(float $s3Sources): self
    {
        $self = clone $this;
        $self['s3Sources'] = $s3Sources;

        return $self;
    }
}
