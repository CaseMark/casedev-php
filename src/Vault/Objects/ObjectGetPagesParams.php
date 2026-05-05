<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Retrieves the raw text of a processed vault object split by page. The object must have completed ingestion before pages can be retrieved — for PDFs this requires the OCR pipeline to have finished writing the per-page sidecar, so freshly uploaded PDFs return 400 with the current `ingestionStatus` until processing completes. For PDFs this returns the per-page OCR text. For plain text files (txt, md, source code, court reporter transcripts) the text is split using right-aligned page-number markers when present (preserving the original document numbering, including continuations like Volume 2 starting at page 234), falling back to form-feed (\f) page-break characters, and finally a single page if neither signal is present. Use the optional `start` and `end` query parameters to fetch a specific inclusive page range. Pages with no text are omitted.
 *
 * @see CaseDev\Services\Vault\ObjectsService::getPages()
 *
 * @phpstan-type ObjectGetPagesParamsShape = array{
 *   id: string, end?: int|null, start?: int|null
 * }
 */
final class ObjectGetPagesParams implements BaseModel
{
    /** @use SdkModel<ObjectGetPagesParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Last page to return (inclusive, 1-indexed). If omitted, returns through the last page with text.
     */
    #[Optional]
    public ?int $end;

    /**
     * First page to return (inclusive, 1-indexed). If omitted, starts at the first page with text.
     */
    #[Optional]
    public ?int $start;

    /**
     * `new ObjectGetPagesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetPagesParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetPagesParams)->withID(...)
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
        ?int $end = null,
        ?int $start = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Last page to return (inclusive, 1-indexed). If omitted, returns through the last page with text.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * First page to return (inclusive, 1-indexed). If omitted, starts at the first page with text.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
