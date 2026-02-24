<?php

declare(strict_types=1);

namespace CaseDev\Search\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Search\V1\V1ResearchParams\Model;

/**
 * Performs deep research by conducting multi-step analysis, gathering information from multiple sources, and providing comprehensive insights. Ideal for legal research, case analysis, and due diligence investigations.
 *
 * @see CaseDev\Services\Search\V1Service::research()
 *
 * @phpstan-type V1ResearchParamsShape = array{
 *   instructions: string,
 *   model?: null|Model|value-of<Model>,
 *   outputSchema?: mixed,
 *   query?: string|null,
 * }
 */
final class V1ResearchParams implements BaseModel
{
    /** @use SdkModel<V1ResearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Research instructions or query.
     */
    #[Required]
    public string $instructions;

    /**
     * Research quality level - fast (quick), normal (balanced), pro (comprehensive).
     *
     * @var value-of<Model>|null $model
     */
    #[Optional(enum: Model::class)]
    public ?string $model;

    /**
     * Optional JSON schema to structure the research output.
     */
    #[Optional]
    public mixed $outputSchema;

    /**
     * Alias for instructions (for convenience).
     */
    #[Optional]
    public ?string $query;

    /**
     * `new V1ResearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ResearchParams::with(instructions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ResearchParams)->withInstructions(...)
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
     * @param Model|value-of<Model>|null $model
     */
    public static function with(
        string $instructions,
        Model|string|null $model = null,
        mixed $outputSchema = null,
        ?string $query = null,
    ): self {
        $self = new self;

        $self['instructions'] = $instructions;

        null !== $model && $self['model'] = $model;
        null !== $outputSchema && $self['outputSchema'] = $outputSchema;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * Research instructions or query.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Research quality level - fast (quick), normal (balanced), pro (comprehensive).
     *
     * @param Model|value-of<Model> $model
     */
    public function withModel(Model|string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Optional JSON schema to structure the research output.
     */
    public function withOutputSchema(mixed $outputSchema): self
    {
        $self = clone $this;
        $self['outputSchema'] = $outputSchema;

        return $self;
    }

    /**
     * Alias for instructions (for convenience).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
