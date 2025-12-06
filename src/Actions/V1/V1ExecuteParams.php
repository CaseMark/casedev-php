<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Execute a multi-step action workflow with the provided input data. Actions can run synchronously (returning results immediately) or asynchronously (with webhook notifications when complete).
 *
 * @see Casedev\Services\Actions\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{
 *   input: array<string,mixed>, webhook_id?: string
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
    #[Api(map: 'mixed')]
    public array $input;

    /**
     * Optional webhook endpoint ID to override the action's default webhook.
     */
    #[Api(optional: true)]
    public ?string $webhook_id;

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
    public static function with(array $input, ?string $webhook_id = null): self
    {
        $obj = new self;

        $obj['input'] = $input;

        null !== $webhook_id && $obj['webhook_id'] = $webhook_id;

        return $obj;
    }

    /**
     * Input data for the action execution.
     *
     * @param array<string,mixed> $input
     */
    public function withInput(array $input): self
    {
        $obj = clone $this;
        $obj['input'] = $input;

        return $obj;
    }

    /**
     * Optional webhook endpoint ID to override the action's default webhook.
     */
    public function withWebhookID(string $webhookID): self
    {
        $obj = clone $this;
        $obj['webhook_id'] = $webhookID;

        return $obj;
    }
}
