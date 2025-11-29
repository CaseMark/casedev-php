<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Search\V1\V1ResearchParams\Model;

/**
 * Performs deep research by conducting multi-step analysis, gathering information from multiple sources, and providing comprehensive insights. Ideal for legal research, case analysis, and due diligence investigations.
 *
 * @see Casedev\Services\Search\V1Service::research()
 *
 * @phpstan-type V1ResearchParamsShape = array{
 *   instructions: string,
 *   model?: Model|value-of<Model>,
 *   outputSchema?: mixed,
 *   query?: string,
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
    #[Api]
    public string $instructions;

    /**
     * Research quality level - fast (quick), normal (balanced), pro (comprehensive).
     *
     * @var value-of<Model>|null $model
     */
    #[Api(enum: Model::class, optional: true)]
    public ?string $model;

    /**
     * Optional JSON schema to structure the research output.
     */
    #[Api(optional: true)]
    public mixed $outputSchema;

    /**
     * Alias for instructions (for convenience).
     */
    #[Api(optional: true)]
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
     * @param Model|value-of<Model> $model
     */
    public static function with(
        string $instructions,
        Model|string|null $model = null,
        mixed $outputSchema = null,
        ?string $query = null,
    ): self {
        $obj = new self;

        $obj->instructions = $instructions;

        null !== $model && $obj['model'] = $model;
        null !== $outputSchema && $obj->outputSchema = $outputSchema;
        null !== $query && $obj->query = $query;

        return $obj;
    }

    /**
     * Research instructions or query.
     */
    public function withInstructions(string $instructions): self
    {
        $obj = clone $this;
        $obj->instructions = $instructions;

        return $obj;
    }

    /**
     * Research quality level - fast (quick), normal (balanced), pro (comprehensive).
     *
     * @param Model|value-of<Model> $model
     */
    public function withModel(Model|string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Optional JSON schema to structure the research output.
     */
    public function withOutputSchema(mixed $outputSchema): self
    {
        $obj = clone $this;
        $obj->outputSchema = $outputSchema;

        return $obj;
    }

    /**
     * Alias for instructions (for convenience).
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj->query = $query;

        return $obj;
    }
}
