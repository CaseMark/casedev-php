<?php

declare(strict_types=1);

namespace CaseDev\System\SystemListServicesResponse;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ServiceShape = array{
 *   id: string,
 *   description: string,
 *   href: string,
 *   icon: string,
 *   name: string,
 *   order: int,
 * }
 */
final class Service implements BaseModel
{
    /** @use SdkModel<ServiceShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $description;

    #[Required]
    public string $href;

    #[Required]
    public string $icon;

    #[Required]
    public string $name;

    #[Required]
    public int $order;

    /**
     * `new Service()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Service::with(
     *   id: ..., description: ..., href: ..., icon: ..., name: ..., order: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Service)
     *   ->withID(...)
     *   ->withDescription(...)
     *   ->withHref(...)
     *   ->withIcon(...)
     *   ->withName(...)
     *   ->withOrder(...)
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
    public static function with(
        string $id,
        string $description,
        string $href,
        string $icon,
        string $name,
        int $order,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['description'] = $description;
        $self['href'] = $href;
        $self['icon'] = $icon;
        $self['name'] = $name;
        $self['order'] = $order;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withHref(string $href): self
    {
        $self = clone $this;
        $self['href'] = $href;

        return $self;
    }

    public function withIcon(string $icon): self
    {
        $self = clone $this;
        $self['icon'] = $icon;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withOrder(int $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }
}
