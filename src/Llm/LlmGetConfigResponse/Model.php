<?php

declare(strict_types=1);

namespace Router\Llm\LlmGetConfigResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type ModelShape = array{
 *   id: string,
 *   modelType: string,
 *   name: string,
 *   description?: string|null,
 *   pricing?: mixed,
 *   specification?: mixed,
 * }
 */
final class Model implements BaseModel
{
    /** @use SdkModel<ModelShape> */
    use SdkModel;

    /**
     * Unique model identifier.
     */
    #[Required]
    public string $id;

    /**
     * Type of model (e.g., language, embedding).
     */
    #[Required]
    public string $modelType;

    /**
     * Human-readable model name.
     */
    #[Required]
    public string $name;

    /**
     * Model description and capabilities.
     */
    #[Optional]
    public ?string $description;

    /**
     * Pricing information for the model.
     */
    #[Optional]
    public mixed $pricing;

    /**
     * Technical specifications and limits.
     */
    #[Optional]
    public mixed $specification;

    /**
     * `new Model()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Model::with(id: ..., modelType: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Model)->withID(...)->withModelType(...)->withName(...)
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
    public static function with(
        string $id,
        string $modelType,
        string $name,
        ?string $description = null,
        mixed $pricing = null,
        mixed $specification = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['modelType'] = $modelType;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $pricing && $self['pricing'] = $pricing;
        null !== $specification && $self['specification'] = $specification;

        return $self;
    }

    /**
     * Unique model identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Type of model (e.g., language, embedding).
     */
    public function withModelType(string $modelType): self
    {
        $self = clone $this;
        $self['modelType'] = $modelType;

        return $self;
    }

    /**
     * Human-readable model name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Model description and capabilities.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Pricing information for the model.
     */
    public function withPricing(mixed $pricing): self
    {
        $self = clone $this;
        $self['pricing'] = $pricing;

        return $self;
    }

    /**
     * Technical specifications and limits.
     */
    public function withSpecification(mixed $specification): self
    {
        $self = clone $this;
        $self['specification'] = $specification;

        return $self;
    }
}
