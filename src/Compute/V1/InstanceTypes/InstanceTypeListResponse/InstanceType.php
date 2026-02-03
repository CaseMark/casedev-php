<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\InstanceTypes\InstanceTypeListResponse;

use Casedev\Compute\V1\InstanceTypes\InstanceTypeListResponse\InstanceType\Specs;
use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SpecsShape from \Casedev\Compute\V1\InstanceTypes\InstanceTypeListResponse\InstanceType\Specs
 *
 * @phpstan-type InstanceTypeShape = array{
 *   description?: string|null,
 *   gpu?: string|null,
 *   name?: string|null,
 *   pricePerHour?: string|null,
 *   regionsAvailable?: list<string>|null,
 *   specs?: null|Specs|SpecsShape,
 * }
 */
final class InstanceType implements BaseModel
{
    /** @use SdkModel<InstanceTypeShape> */
    use SdkModel;

    /**
     * Instance description.
     */
    #[Optional]
    public ?string $description;

    /**
     * GPU model and count.
     */
    #[Optional]
    public ?string $gpu;

    /**
     * Instance type identifier.
     */
    #[Optional]
    public ?string $name;

    /**
     * Price per hour (e.g. '$1.20').
     */
    #[Optional]
    public ?string $pricePerHour;

    /**
     * Available regions.
     *
     * @var list<string>|null $regionsAvailable
     */
    #[Optional(list: 'string')]
    public ?array $regionsAvailable;

    #[Optional]
    public ?Specs $specs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $regionsAvailable
     * @param Specs|SpecsShape|null $specs
     */
    public static function with(
        ?string $description = null,
        ?string $gpu = null,
        ?string $name = null,
        ?string $pricePerHour = null,
        ?array $regionsAvailable = null,
        Specs|array|null $specs = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $gpu && $self['gpu'] = $gpu;
        null !== $name && $self['name'] = $name;
        null !== $pricePerHour && $self['pricePerHour'] = $pricePerHour;
        null !== $regionsAvailable && $self['regionsAvailable'] = $regionsAvailable;
        null !== $specs && $self['specs'] = $specs;

        return $self;
    }

    /**
     * Instance description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * GPU model and count.
     */
    public function withGPU(string $gpu): self
    {
        $self = clone $this;
        $self['gpu'] = $gpu;

        return $self;
    }

    /**
     * Instance type identifier.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Price per hour (e.g. '$1.20').
     */
    public function withPricePerHour(string $pricePerHour): self
    {
        $self = clone $this;
        $self['pricePerHour'] = $pricePerHour;

        return $self;
    }

    /**
     * Available regions.
     *
     * @param list<string> $regionsAvailable
     */
    public function withRegionsAvailable(array $regionsAvailable): self
    {
        $self = clone $this;
        $self['regionsAvailable'] = $regionsAvailable;

        return $self;
    }

    /**
     * @param Specs|SpecsShape $specs
     */
    public function withSpecs(Specs|array $specs): self
    {
        $self = clone $this;
        $self['specs'] = $specs;

        return $self;
    }
}
