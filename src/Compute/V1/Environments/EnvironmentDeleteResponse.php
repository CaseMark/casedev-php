<?php

declare(strict_types=1);

namespace Router\Compute\V1\Environments;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type EnvironmentDeleteResponseShape = array{
 *   message: string, success: bool
 * }
 */
final class EnvironmentDeleteResponse implements BaseModel
{
    /** @use SdkModel<EnvironmentDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public string $message;

    #[Required]
    public bool $success;

    /**
     * `new EnvironmentDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EnvironmentDeleteResponse::with(message: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EnvironmentDeleteResponse)->withMessage(...)->withSuccess(...)
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
    public static function with(string $message, bool $success): self
    {
        $self = new self;

        $self['message'] = $message;
        $self['success'] = $success;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
