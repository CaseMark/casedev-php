<?php

declare(strict_types=1);

namespace Casedev\Actions\V1;

use Casedev\Actions\V1\V1CreateParams\Definition;
use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Create a new action definition for multi-step workflow automation. Actions can be defined using YAML or JSON format and support complex workflows including document processing, data extraction, and analysis pipelines.
 *
 * @see Casedev\Services\Actions\V1Service::create()
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   definition: mixed|string,
 *   name: string,
 *   description?: string,
 *   webhook_id?: string,
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Action definition in YAML string, JSON string, or JSON object format.
     *
     * @var mixed|string $definition
     */
    #[Api(union: Definition::class)]
    public mixed $definition;

    /**
     * Unique name for the action.
     */
    #[Api]
    public string $name;

    /**
     * Optional description of the action's purpose.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Optional webhook endpoint ID for action completion notifications.
     */
    #[Api(optional: true)]
    public ?string $webhook_id;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(definition: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withDefinition(...)->withName(...)
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
     * @param mixed|string $definition
     */
    public static function with(
        mixed $definition,
        string $name,
        ?string $description = null,
        ?string $webhook_id = null,
    ): self {
        $obj = new self;

        $obj['definition'] = $definition;
        $obj['name'] = $name;

        null !== $description && $obj['description'] = $description;
        null !== $webhook_id && $obj['webhook_id'] = $webhook_id;

        return $obj;
    }

    /**
     * Action definition in YAML string, JSON string, or JSON object format.
     *
     * @param mixed|string $definition
     */
    public function withDefinition(mixed $definition): self
    {
        $obj = clone $this;
        $obj['definition'] = $definition;

        return $obj;
    }

    /**
     * Unique name for the action.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Optional description of the action's purpose.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Optional webhook endpoint ID for action completion notifications.
     */
    public function withWebhookID(string $webhookID): self
    {
        $obj = clone $this;
        $obj['webhook_id'] = $webhookID;

        return $obj;
    }
}
