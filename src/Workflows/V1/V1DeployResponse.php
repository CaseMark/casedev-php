<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1DeployResponseShape = array{
 *   message?: string|null,
 *   success?: bool|null,
 *   webhookSecret?: string|null,
 *   webhookURL?: string|null,
 * }
 */
final class V1DeployResponse implements BaseModel
{
    /** @use SdkModel<V1DeployResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $message;

    #[Optional]
    public ?bool $success;

    /**
     * Only returned once - save this!
     */
    #[Optional]
    public ?string $webhookSecret;

    #[Optional('webhookUrl')]
    public ?string $webhookURL;

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
        ?bool $success = null,
        ?string $webhookSecret = null,
        ?string $webhookURL = null,
    ): self {
        $self = new self;

        null !== $message && $self['message'] = $message;
        null !== $success && $self['success'] = $success;
        null !== $webhookSecret && $self['webhookSecret'] = $webhookSecret;
        null !== $webhookURL && $self['webhookURL'] = $webhookURL;

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

    /**
     * Only returned once - save this!
     */
    public function withWebhookSecret(string $webhookSecret): self
    {
        $self = clone $this;
        $self['webhookSecret'] = $webhookSecret;

        return $self;
    }

    public function withWebhookURL(string $webhookURL): self
    {
        $self = clone $this;
        $self['webhookURL'] = $webhookURL;

        return $self;
    }
}
