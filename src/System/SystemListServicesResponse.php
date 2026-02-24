<?php

declare(strict_types=1);

namespace CaseDev\System;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\System\SystemListServicesResponse\Service;

/**
 * @phpstan-import-type ServiceShape from \CaseDev\System\SystemListServicesResponse\Service
 *
 * @phpstan-type SystemListServicesResponseShape = array{
 *   services: list<Service|ServiceShape>
 * }
 */
final class SystemListServicesResponse implements BaseModel
{
    /** @use SdkModel<SystemListServicesResponseShape> */
    use SdkModel;

    /** @var list<Service> $services */
    #[Required(list: Service::class)]
    public array $services;

    /**
     * `new SystemListServicesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SystemListServicesResponse::with(services: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SystemListServicesResponse)->withServices(...)
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
     *
     * @param list<Service|ServiceShape> $services
     */
    public static function with(array $services): self
    {
        $self = new self;

        $self['services'] = $services;

        return $self;
    }

    /**
     * @param list<Service|ServiceShape> $services
     */
    public function withServices(array $services): self
    {
        $self = clone $this;
        $self['services'] = $services;

        return $self;
    }
}
