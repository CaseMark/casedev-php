<?php

declare(strict_types=1);

namespace Router\Superdoc\V1\V1AnnotateParams;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * Document source - provide either URL or base64.
 *
 * @phpstan-type DocumentShape = array{base64?: string|null, url?: string|null}
 */
final class Document implements BaseModel
{
    /** @use SdkModel<DocumentShape> */
    use SdkModel;

    /**
     * Base64-encoded DOCX template.
     */
    #[Optional]
    public ?string $base64;

    /**
     * URL to the DOCX template.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $base64 = null, ?string $url = null): self
    {
        $self = new self;

        null !== $base64 && $self['base64'] = $base64;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Base64-encoded DOCX template.
     */
    public function withBase64(string $base64): self
    {
        $self = clone $this;
        $self['base64'] = $base64;

        return $self;
    }

    /**
     * URL to the DOCX template.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
