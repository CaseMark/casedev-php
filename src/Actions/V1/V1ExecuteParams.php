<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Execute a multi-step action workflow with the provided input data. Actions can run synchronously (returning results immediately) or asynchronously (with webhook notifications when complete).
 *
 * @see Casedev\Services\Actions\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{
 *   input: array<string,mixed>, webhookID?: string
 * }
 */
final class V1ExecuteParams implements BaseModel
{
    /** @use SdkModel<V1ExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Input data for the action execution.
     *
     * @var array<string,mixed> $input
     */
    #[Required(map: 'mixed')]
    public array $input;

    /**
     * Optional webhook endpoint ID to override the action's default webhook.
     */
    #[Optional('webhook_id')]
    public ?string $webhookID;

    /**
     * `new V1ExecuteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ExecuteParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ExecuteParams)->withInput(...)
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
     * @param array<string,mixed> $input
     */
    public static function with(array $input, ?string $webhookID = null): self
    {
        $self = new self;

        $self['input'] = $input;

        null !== $webhookID && $self['webhookID'] = $webhookID;

        return $self;
    }

    /**
     * Input data for the action execution.
     *
     * @param array<string,mixed> $input
     */
    public function withInput(array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Optional webhook endpoint ID to override the action's default webhook.
     */
    public function withWebhookID(string $webhookID): self
    {
        $self = clone $this;
        $self['webhookID'] = $webhookID;

        return $self;
    }
}
