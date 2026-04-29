<?php

declare(strict_types=1);

namespace CaseDev\Worker\V1;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Forwards a POST request to the worker runtime without translating request, response, or SSE event shapes.
 *
 * @see CaseDev\Services\Worker\V1Service::proxyPost()
 *
 * @phpstan-type V1ProxyPostParamsShape = array{id: string}
 */
final class V1ProxyPostParams implements BaseModel
{
    /** @use SdkModel<V1ProxyPostParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new V1ProxyPostParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProxyPostParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ProxyPostParams)->withID(...)
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
