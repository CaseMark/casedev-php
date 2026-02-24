<?php

declare(strict_types=1);

namespace CaseDev\Superdoc\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Superdoc\V1\V1ConvertParams\From;
use CaseDev\Superdoc\V1\V1ConvertParams\To;

/**
 * Convert documents between formats using SuperDoc. Supports DOCX to PDF, Markdown to DOCX, and HTML to DOCX conversions.
 *
 * @see CaseDev\Services\Superdoc\V1Service::convert()
 *
 * @phpstan-type V1ConvertParamsShape = array{
 *   from: From|value-of<From>,
 *   documentBase64?: string|null,
 *   documentURL?: string|null,
 *   to?: null|To|value-of<To>,
 * }
 */
final class V1ConvertParams implements BaseModel
{
    /** @use SdkModel<V1ConvertParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Source format of the document.
     *
     * @var value-of<From> $from
     */
    #[Required(enum: From::class)]
    public string $from;

    /**
     * Base64-encoded document content.
     */
    #[Optional('document_base64')]
    public ?string $documentBase64;

    /**
     * URL to the document to convert.
     */
    #[Optional('document_url')]
    public ?string $documentURL;

    /**
     * Target format for conversion.
     *
     * @var value-of<To>|null $to
     */
    #[Optional(enum: To::class)]
    public ?string $to;

    /**
     * `new V1ConvertParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ConvertParams::with(from: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ConvertParams)->withFrom(...)
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
     * @param From|value-of<From> $from
     * @param To|value-of<To>|null $to
     */
    public static function with(
        From|string $from,
        ?string $documentBase64 = null,
        ?string $documentURL = null,
        To|string|null $to = null,
    ): self {
        $self = new self;

        $self['from'] = $from;

        null !== $documentBase64 && $self['documentBase64'] = $documentBase64;
        null !== $documentURL && $self['documentURL'] = $documentURL;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * Source format of the document.
     *
     * @param From|value-of<From> $from
     */
    public function withFrom(From|string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Base64-encoded document content.
     */
    public function withDocumentBase64(string $documentBase64): self
    {
        $self = clone $this;
        $self['documentBase64'] = $documentBase64;

        return $self;
    }

    /**
     * URL to the document to convert.
     */
    public function withDocumentURL(string $documentURL): self
    {
        $self = clone $this;
        $self['documentURL'] = $documentURL;

        return $self;
    }

    /**
     * Target format for conversion.
     *
     * @param To|value-of<To> $to
     */
    public function withTo(To|string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
