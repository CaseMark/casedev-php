<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Download OCR processing results in various formats. Returns the processed document as text extraction, structured JSON with coordinates, searchable PDF with text layer, or the original uploaded document.
 *
 * @see Casedev\Services\Ocr\V1Service::download()
 *
 * @phpstan-type V1DownloadParamsShape = array{id: string}
 */
final class V1DownloadParams implements BaseModel
{
    /** @use SdkModel<V1DownloadParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new V1DownloadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DownloadParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DownloadParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
