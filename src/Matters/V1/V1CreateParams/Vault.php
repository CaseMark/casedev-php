<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\V1CreateParams;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VaultShape = array{
 *   description?: string|null,
 *   enableGraph?: bool|null,
 *   enableIndexing?: bool|null,
 *   metadata?: array<string,mixed>|null,
 * }
 */
final class Vault implements BaseModel
{
    /** @use SdkModel<VaultShape> */
    use SdkModel;

    #[Optional]
    public ?string $description;

    #[Optional]
    public ?bool $enableGraph;

    #[Optional]
    public ?bool $enableIndexing;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $metadata
     */
    public static function with(
        ?string $description = null,
        ?bool $enableGraph = null,
        ?bool $enableIndexing = null,
        ?array $metadata = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $enableGraph && $self['enableGraph'] = $enableGraph;
        null !== $enableIndexing && $self['enableIndexing'] = $enableIndexing;
        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withEnableGraph(bool $enableGraph): self
    {
        $self = clone $this;
        $self['enableGraph'] = $enableGraph;

        return $self;
    }

    public function withEnableIndexing(bool $enableIndexing): self
    {
        $self = clone $this;
        $self['enableIndexing'] = $enableIndexing;

        return $self;
    }

    /**
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
