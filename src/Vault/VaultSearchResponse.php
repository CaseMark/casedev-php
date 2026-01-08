<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultSearchResponse\Chunk;
use Casedev\Vault\VaultSearchResponse\Source;

/**
 * @phpstan-import-type ChunkShape from \Casedev\Vault\VaultSearchResponse\Chunk
 * @phpstan-import-type SourceShape from \Casedev\Vault\VaultSearchResponse\Source
 *
 * @phpstan-type VaultSearchResponseShape = array{
 *   chunks?: list<Chunk|ChunkShape>|null,
 *   method?: string|null,
 *   query?: string|null,
 *   response?: string|null,
 *   sources?: list<Source|SourceShape>|null,
 *   vaultID?: string|null,
 * }
 */
final class VaultSearchResponse implements BaseModel
{
    /** @use SdkModel<VaultSearchResponseShape> */
    use SdkModel;

    /**
     * Relevant text chunks with similarity scores.
     *
     * @var list<Chunk>|null $chunks
     */
    #[Optional(list: Chunk::class)]
    public ?array $chunks;

    /**
     * Search method used.
     */
    #[Optional]
    public ?string $method;

    /**
     * Original search query.
     */
    #[Optional]
    public ?string $query;

    /**
     * AI-generated answer based on search results (for global/entity methods).
     */
    #[Optional]
    public ?string $response;

    /** @var list<Source>|null $sources */
    #[Optional(list: Source::class)]
    public ?array $sources;

    /**
     * ID of the searched vault.
     */
    #[Optional('vault_id')]
    public ?string $vaultID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Chunk|ChunkShape>|null $chunks
     * @param list<Source|SourceShape>|null $sources
     */
    public static function with(
        ?array $chunks = null,
        ?string $method = null,
        ?string $query = null,
        ?string $response = null,
        ?array $sources = null,
        ?string $vaultID = null,
    ): self {
        $self = new self;

        null !== $chunks && $self['chunks'] = $chunks;
        null !== $method && $self['method'] = $method;
        null !== $query && $self['query'] = $query;
        null !== $response && $self['response'] = $response;
        null !== $sources && $self['sources'] = $sources;
        null !== $vaultID && $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Relevant text chunks with similarity scores.
     *
     * @param list<Chunk|ChunkShape> $chunks
     */
    public function withChunks(array $chunks): self
    {
        $self = clone $this;
        $self['chunks'] = $chunks;

        return $self;
    }

    /**
     * Search method used.
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * Original search query.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * AI-generated answer based on search results (for global/entity methods).
     */
    public function withResponse(string $response): self
    {
        $self = clone $this;
        $self['response'] = $response;

        return $self;
    }

    /**
     * @param list<Source|SourceShape> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * ID of the searched vault.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
