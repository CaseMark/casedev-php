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
        $obj = new self;

        null !== $message && $obj['message'] = $message;
        null !== $success && $obj['success'] = $success;
        null !== $webhookSecret && $obj['webhookSecret'] = $webhookSecret;
        null !== $webhookURL && $obj['webhookURL'] = $webhookURL;

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

    /**
     * Only returned once - save this!
     */
    public function withWebhookSecret(string $webhookSecret): self
    {
        $obj = clone $this;
        $obj['webhookSecret'] = $webhookSecret;

        return $obj;
    }

    public function withWebhookURL(string $webhookURL): self
    {
        $obj = clone $this;
        $obj['webhookURL'] = $webhookURL;

        return $obj;
    }
}
