<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Workflows\V1\V1ExecuteParams\Options;

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
 * @see Casedev\Services\Workflows\V1Service::execute()
 *
 * @phpstan-type V1ExecuteParamsShape = array{input: mixed, options?: Options}
 */
final class V1ExecuteParams implements BaseModel
{
    /** @use SdkModel<V1ExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Input data for the workflow (structure varies by workflow type).
     */
    #[Api]
    public mixed $input;

    #[Api(optional: true)]
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
     */
    public static function with(mixed $input, ?Options $options = null): self
    {
        $obj = new self;

        $obj->input = $input;

        null !== $options && $obj->options = $options;

        return $obj;
    }

    /**
     * Input data for the workflow (structure varies by workflow type).
     */
    public function withInput(mixed $input): self
    {
        $obj = clone $this;
        $obj->input = $input;

        return $obj;
    }

    public function withOptions(Options $options): self
    {
        $obj = clone $this;
        $obj->options = $options;

        return $obj;
    }
}
