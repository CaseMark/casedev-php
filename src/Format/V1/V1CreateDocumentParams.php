<?php

declare(strict_types=1);

namespace Router\Format\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Format\V1\V1CreateDocumentParams\InputFormat;
use Router\Format\V1\V1CreateDocumentParams\Options;
use Router\Format\V1\V1CreateDocumentParams\OutputFormat;

/**
 * Convert Markdown, JSON, or text content to professionally formatted PDF, DOCX, or HTML documents. Supports template components with variable interpolation for creating consistent legal documents like contracts, briefs, and reports.
 *
 * @see Router\Services\Format\V1Service::createDocument()
 *
 * @phpstan-import-type OptionsShape from \Router\Format\V1\V1CreateDocumentParams\Options
 *
 * @phpstan-type V1CreateDocumentParamsShape = array{
 *   content: string,
 *   outputFormat: OutputFormat|value-of<OutputFormat>,
 *   inputFormat?: null|InputFormat|value-of<InputFormat>,
 *   options?: null|Options|OptionsShape,
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
     * @var value-of<OutputFormat> $outputFormat
     */
    #[Required('output_format', enum: OutputFormat::class)]
    public string $outputFormat;

    /**
     * Format of the input content.
     *
     * @var value-of<InputFormat>|null $inputFormat
     */
    #[Optional('input_format', enum: InputFormat::class)]
    public ?string $inputFormat;

    #[Optional]
    public ?Options $options;

    /**
     * `new V1CreateDocumentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateDocumentParams::with(content: ..., outputFormat: ...)
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
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     * @param InputFormat|value-of<InputFormat>|null $inputFormat
     * @param Options|OptionsShape|null $options
     */
    public static function with(
        string $content,
        OutputFormat|string $outputFormat,
        InputFormat|string|null $inputFormat = null,
        Options|array|null $options = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['outputFormat'] = $outputFormat;

        null !== $inputFormat && $self['inputFormat'] = $inputFormat;
        null !== $options && $self['options'] = $options;

        return $self;
    }

    /**
     * The source content to format.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Desired output format.
     *
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     */
    public function withOutputFormat(OutputFormat|string $outputFormat): self
    {
        $self = clone $this;
        $self['outputFormat'] = $outputFormat;

        return $self;
    }

    /**
     * Format of the input content.
     *
     * @param InputFormat|value-of<InputFormat> $inputFormat
     */
    public function withInputFormat(InputFormat|string $inputFormat): self
    {
        $self = clone $this;
        $self['inputFormat'] = $inputFormat;

        return $self;
    }

    /**
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
