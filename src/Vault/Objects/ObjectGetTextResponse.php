<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\Objects\ObjectGetTextResponse\Metadata;

/**
 * @phpstan-import-type MetadataShape from \Casedev\Vault\Objects\ObjectGetTextResponse\Metadata
 *
 * @phpstan-type ObjectGetTextResponseShape = array{
 *   metadata?: null|Metadata|MetadataShape, text?: string|null
 * }
 */
final class ObjectGetTextResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetTextResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Metadata $metadata;

    /**
     * Full concatenated text content from all chunks.
     */
    #[Optional]
    public ?string $text;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Metadata|MetadataShape|null $metadata
     */
    public static function with(
        Metadata|array|null $metadata = null,
        ?string $text = null
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Full concatenated text content from all chunks.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
