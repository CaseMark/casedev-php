<?php

declare(strict_types=1);

namespace Router\Legal\V1;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Search for a jurisdiction by name. Returns matching jurisdictions with their IDs for use in legal.find() and other legal research endpoints.
 *
 * @see Router\Services\Legal\V1Service::listJurisdictions()
 *
 * @phpstan-type V1ListJurisdictionsParamsShape = array{name: string}
 */
final class V1ListJurisdictionsParams implements BaseModel
{
    /** @use SdkModel<V1ListJurisdictionsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Jurisdiction name (e.g., "California", "US Federal", "NY").
     */
    #[Required]
    public string $name;

    /**
     * `new V1ListJurisdictionsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ListJurisdictionsParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ListJurisdictionsParams)->withName(...)
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
     * Jurisdiction name (e.g., "California", "US Federal", "NY").
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
