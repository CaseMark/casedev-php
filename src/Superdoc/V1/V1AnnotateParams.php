<?php

declare(strict_types=1);

namespace Router\Superdoc\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Superdoc\V1\V1AnnotateParams\Document;
use Router\Superdoc\V1\V1AnnotateParams\Field;
use Router\Superdoc\V1\V1AnnotateParams\OutputFormat;

/**
 * Populate fields inside a DOCX template using SuperDoc annotations. Supports text, images, dates, and numbers. Can target individual fields by ID or multiple fields by group.
 *
 * @see Router\Services\Superdoc\V1Service::annotate()
 *
 * @phpstan-import-type DocumentShape from \Router\Superdoc\V1\V1AnnotateParams\Document
 * @phpstan-import-type FieldShape from \Router\Superdoc\V1\V1AnnotateParams\Field
 *
 * @phpstan-type V1AnnotateParamsShape = array{
 *   document: Document|DocumentShape,
 *   fields: list<Field|FieldShape>,
 *   outputFormat?: null|OutputFormat|value-of<OutputFormat>,
 * }
 */
final class V1AnnotateParams implements BaseModel
{
    /** @use SdkModel<V1AnnotateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Document source - provide either URL or base64.
     */
    #[Required]
    public Document $document;

    /**
     * Fields to populate in the template.
     *
     * @var list<Field> $fields
     */
    #[Required(list: Field::class)]
    public array $fields;

    /**
     * Output format for the annotated document.
     *
     * @var value-of<OutputFormat>|null $outputFormat
     */
    #[Optional('output_format', enum: OutputFormat::class)]
    public ?string $outputFormat;

    /**
     * `new V1AnnotateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1AnnotateParams::with(document: ..., fields: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1AnnotateParams)->withDocument(...)->withFields(...)
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
     * @param Document|DocumentShape $document
     * @param list<Field|FieldShape> $fields
     * @param OutputFormat|value-of<OutputFormat>|null $outputFormat
     */
    public static function with(
        Document|array $document,
        array $fields,
        OutputFormat|string|null $outputFormat = null,
    ): self {
        $self = new self;

        $self['document'] = $document;
        $self['fields'] = $fields;

        null !== $outputFormat && $self['outputFormat'] = $outputFormat;

        return $self;
    }

    /**
     * Document source - provide either URL or base64.
     *
     * @param Document|DocumentShape $document
     */
    public function withDocument(Document|array $document): self
    {
        $self = clone $this;
        $self['document'] = $document;

        return $self;
    }

    /**
     * Fields to populate in the template.
     *
     * @param list<Field|FieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    /**
     * Output format for the annotated document.
     *
     * @param OutputFormat|value-of<OutputFormat> $outputFormat
     */
    public function withOutputFormat(OutputFormat|string $outputFormat): self
    {
        $self = clone $this;
        $self['outputFormat'] = $outputFormat;

        return $self;
    }
}
