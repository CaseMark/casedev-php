<?php

declare(strict_types=1);

namespace Casedev\Templates\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Templates\V1\V1ExecuteParams\Options;
use Casedev\Templates\V1\V1ExecuteParams\Options\Format;

/**
 * Execute a pre-built workflow with custom input data. Workflows automate common legal document processing tasks like contract analysis, due diligence reviews, and document classification.
 *
 * **Available Workflows:**
 * - Contract analysis and risk assessment
 * - Document classification and tagging
 * - Legal research and case summarization
 * - Due diligence document review
 * - Compliance checking and reporting
 *
 * @see Casedev\Services\Templates\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{
 *   input: mixed,
 *   options?: Options|array{format?: value-of<Format>|null, model?: string|null},
 * }
 */
final class V1ExecuteParams implements BaseModel
{
    /** @use SdkModel<V1ExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Input data for the workflow (structure varies by workflow type).
     */
    #[Required]
    public mixed $input;

    #[Optional]
    public ?Options $options;

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
     * @param Options|array{
     *   format?: value-of<Format>|null, model?: string|null
     * } $options
     */
    public static function with(
        mixed $input,
        Options|array|null $options = null
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $options && $self['options'] = $options;

        return $self;
    }

    /**
     * Input data for the workflow (structure varies by workflow type).
     */
    public function withInput(mixed $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * @param Options|array{
     *   format?: value-of<Format>|null, model?: string|null
     * } $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
