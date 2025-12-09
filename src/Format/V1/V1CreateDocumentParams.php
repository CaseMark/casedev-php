<?php

declare(strict_types=1);

namespace Casedev\Format\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Format\V1\V1CreateDocumentParams\InputFormat;
use Casedev\Format\V1\V1CreateDocumentParams\Options;
use Casedev\Format\V1\V1CreateDocumentParams\Options\Component;
use Casedev\Format\V1\V1CreateDocumentParams\OutputFormat;

/**
 * Convert Markdown, JSON, or text content to professionally formatted PDF, DOCX, or HTML documents. Supports template components with variable interpolation for creating consistent legal documents like contracts, briefs, and reports.
 *
 * @see Casedev\Services\Format\V1Service::createDocument()
 *
 * @phpstan-type V1CreateDocumentParamsShape = array{
 *   content: string,
 *   output_format: OutputFormat|value-of<OutputFormat>,
 *   input_format?: InputFormat|value-of<InputFormat>,
 *   options?: Options|array{components?: list<Component>|null},
 * }
 */
final class V1CreateDocumentParams implements BaseModel
{
    /** @use SdkModel<V1CreateDocumentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The source content to format.
     */
    #[Required]
    public string $content;

    /**
     * Desired output format.
     *
     * @var value-of<OutputFormat> $output_format
     */
    #[Required(enum: OutputFormat::class)]
    public string $output_format;

    /**
     * Format of the input content.
     *
     * @var value-of<InputFormat>|null $input_format
     */
    #[Optional(enum: InputFormat::class)]
    public ?string $input_format;

    #[Optional]
    public ?Options $options;

    /**
     * `new V1CreateDocumentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateDocumentParams::with(content: ..., output_format: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateDocumentParams)->withContent(...)->withOutputFormat(...)
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
     * @param OutputFormat|value-of<OutputFormat> $output_format
     * @param InputFormat|value-of<InputFormat> $input_format
     * @param Options|array{components?: list<Component>|null} $options
     */
    public static function with(
        string $content,
        OutputFormat|string $output_format,
        InputFormat|string|null $input_format = null,
        Options|array|null $options = null,
    ): self {
        $obj = new self;

        $obj['content'] = $content;
        $obj['output_format'] = $output_format;

        null !== $input_format && $obj['input_format'] = $input_format;
        null !== $options && $obj['options'] = $options;

        return $obj;
    }

    /**
     * The source content to format.
     */
    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * Desired output format.
     *
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     */
    public function withOutputFormat(OutputFormat|string $outputFormat): self
    {
        $obj = clone $this;
        $obj['output_format'] = $outputFormat;

        return $obj;
    }

    /**
     * Format of the input content.
     *
     * @param InputFormat|value-of<InputFormat> $inputFormat
     */
    public function withInputFormat(InputFormat|string $inputFormat): self
    {
        $obj = clone $this;
        $obj['input_format'] = $inputFormat;

        return $obj;
    }

    /**
     * @param Options|array{components?: list<Component>|null} $options
     */
    public function withOptions(Options|array $options): self
    {
        $obj = clone $this;
        $obj['options'] = $options;

        return $obj;
    }
}
