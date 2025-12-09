<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Environments;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EnvironmentDeleteResponseShape = array{
 *   message: string, success: bool
 * }
 */
final class EnvironmentDeleteResponse implements BaseModel
{
    /** @use SdkModel<EnvironmentDeleteResponseShape> */
    use SdkModel;

    #[Api]
    public string $message;

    #[Api]
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
        $obj = new self;

        $obj['message'] = $message;
        $obj['success'] = $success;

        return $obj;
    }

    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }

    public function withSuccess(bool $success): self
    {
        $obj = clone $this;
        $obj['success'] = $success;

        return $obj;
    }
}
