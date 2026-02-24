<?php

declare(strict_types=1);

namespace CaseDev\Vault\Multipart;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Multipart\MultipartGetPartURLsResponse\URL;

/**
 * @phpstan-import-type URLShape from \CaseDev\Vault\Multipart\MultipartGetPartURLsResponse\URL
 *
 * @phpstan-type MultipartGetPartURLsResponseShape = array{
 *   urls?: list<URL|URLShape>|null
 * }
 */
final class MultipartGetPartURLsResponse implements BaseModel
{
    /** @use SdkModel<MultipartGetPartURLsResponseShape> */
    use SdkModel;

    /** @var list<URL>|null $urls */
    #[Optional(list: URL::class)]
    public ?array $urls;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<URL|URLShape>|null $urls
     */
    public static function with(?array $urls = null): self
    {
        $self = new self;

        null !== $urls && $self['urls'] = $urls;

        return $self;
    }

    /**
     * @param list<URL|URLShape> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

        return $self;
    }
}
