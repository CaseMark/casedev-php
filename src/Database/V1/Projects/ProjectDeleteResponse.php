<?php

declare(strict_types=1);

namespace CaseDev\Database\V1\Projects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProjectDeleteResponseShape = array{message: string, success: bool}
 */
final class ProjectDeleteResponse implements BaseModel
{
    /** @use SdkModel<ProjectDeleteResponseShape> */
    use SdkModel;

    /**
     * Confirmation message.
     */
    #[Required]
    public string $message;

    /**
     * Deletion success indicator.
     */
    #[Required]
    public bool $success;

    /**
     * `new ProjectDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectDeleteResponse::with(message: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectDeleteResponse)->withMessage(...)->withSuccess(...)
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

    /**
     * Confirmation message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Deletion success indicator.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
