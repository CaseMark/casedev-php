<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultNewResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * The resolved embedding profile for this vault. Null for storage-only vaults.
 *
 * @phpstan-type EmbeddingProfileShape = array{
 *   dimensions?: int|null, model?: string|null, provider?: string|null
 * }
 */
final class EmbeddingProfile implements BaseModel
{
    /** @use SdkModel<EmbeddingProfileShape> */
    use SdkModel;

    /**
     * Vector dimension used by this vault.
     */
    #[Optional]
    public ?int $dimensions;

    /**
     * Embedding model catalog key.
     */
    #[Optional]
    public ?string $model;

    /**
     * Embedding provider.
     */
    #[Optional]
    public ?string $provider;

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
        ?int $dimensions = null,
        ?string $model = null,
        ?string $provider = null
    ): self {
        $self = new self;

        null !== $dimensions && $self['dimensions'] = $dimensions;
        null !== $model && $self['model'] = $model;
        null !== $provider && $self['provider'] = $provider;

        return $self;
    }

    /**
     * Vector dimension used by this vault.
     */
    public function withDimensions(int $dimensions): self
    {
        $self = clone $this;
        $self['dimensions'] = $dimensions;

        return $self;
    }

    /**
     * Embedding model catalog key.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Embedding provider.
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }
}
