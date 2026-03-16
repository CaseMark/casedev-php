<?php

declare(strict_types=1);

namespace CaseDev\Operator\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Operator\V1\V1CreateParams\Size;

/**
 * Provision a new operator instance for the organization.
 *
 * @see CaseDev\Services\Operator\V1Service::create()
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   name: string, model?: string|null, size?: null|Size|value-of<Size>
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Operator name.
     */
    #[Required]
    public string $name;

    /**
     * Model to use.
     */
    #[Optional]
    public ?string $model;

    /**
     * Instance size.
     *
     * @var value-of<Size>|null $size
     */
    #[Optional(enum: Size::class)]
    public ?string $size;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withName(...)
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
     * @param Size|value-of<Size>|null $size
     */
    public static function with(
        string $name,
        ?string $model = null,
        Size|string|null $size = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $model && $self['model'] = $model;
        null !== $size && $self['size'] = $size;

        return $self;
    }

    /**
     * Operator name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Model to use.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Instance size.
     *
     * @param Size|value-of<Size> $size
     */
    public function withSize(Size|string $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }
}
