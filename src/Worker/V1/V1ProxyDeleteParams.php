<?php

declare(strict_types=1);

namespace CaseDev\Worker\V1;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Forwards a DELETE request to the worker runtime without translating response shapes.
 *
 * @see CaseDev\Services\Worker\V1Service::proxyDelete()
 *
 * @phpstan-type V1ProxyDeleteParamsShape = array{id: string}
 */
final class V1ProxyDeleteParams implements BaseModel
{
    /** @use SdkModel<V1ProxyDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new V1ProxyDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProxyDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ProxyDeleteParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
