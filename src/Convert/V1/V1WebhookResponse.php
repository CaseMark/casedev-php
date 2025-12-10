<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1WebhookResponseShape = array{
 *   message?: string|null, success?: bool|null
 * }
 */
final class V1WebhookResponse implements BaseModel
{
    /** @use SdkModel<V1WebhookResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?bool $success;

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
        ?string $message = null,
        ?bool $success = null
    ): self {
        $self = new self;

        null !== $message && $self['message'] = $message;
        null !== $success && $self['success'] = $success;

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
