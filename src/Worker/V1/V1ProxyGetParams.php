<?php

declare(strict_types=1);

namespace CaseDev\Worker\V1;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Forwards a GET request to the worker runtime without translating response or SSE event shapes.
 *
 * @see CaseDev\Services\Worker\V1Service::proxyGet()
 *
 * @phpstan-type V1ProxyGetParamsShape = array{id: string}
 */
final class V1ProxyGetParams implements BaseModel
{
    /** @use SdkModel<V1ProxyGetParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new V1ProxyGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProxyGetParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ProxyGetParams)->withID(...)
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
