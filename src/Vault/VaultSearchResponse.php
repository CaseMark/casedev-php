<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultSearchResponse\Chunk;
use Casedev\Vault\VaultSearchResponse\Source;

/**
 * @phpstan-type VaultSearchResponseShape = array{
 *   chunks?: list<Chunk>|null,
 *   method?: string|null,
 *   query?: string|null,
 *   response?: string|null,
 *   sources?: list<Source>|null,
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
     * @param list<Chunk|array{
     *   score?: float|null, source?: string|null, text?: string|null
     * }> $chunks
     * @param list<Source|array{
     *   id?: string|null,
     *   chunkCount?: int|null,
     *   createdAt?: \DateTimeInterface|null,
     *   filename?: string|null,
     *   ingestionCompletedAt?: \DateTimeInterface|null,
     *   pageCount?: int|null,
     *   textLength?: int|null,
     * }> $sources
     */
    public static function with(
        ?array $chunks = null,
        ?string $method = null,
        ?string $query = null,
        ?string $response = null,
        ?array $sources = null,
        ?string $vaultID = null,
    ): self {
        $obj = new self;

        null !== $chunks && $obj['chunks'] = $chunks;
        null !== $method && $obj['method'] = $method;
        null !== $query && $obj['query'] = $query;
        null !== $response && $obj['response'] = $response;
        null !== $sources && $obj['sources'] = $sources;
        null !== $vaultID && $obj['vaultID'] = $vaultID;

        return $obj;
    }

    /**
     * Relevant text chunks with similarity scores.
     *
     * @param list<Chunk|array{
     *   score?: float|null, source?: string|null, text?: string|null
     * }> $chunks
     */
    public function withChunks(array $chunks): self
    {
        $obj = clone $this;
        $obj['chunks'] = $chunks;

        return $obj;
    }

    /**
     * Search method used.
     */
    public function withMethod(string $method): self
    {
        $obj = clone $this;
        $obj['method'] = $method;

        return $obj;
    }

    /**
     * Original search query.
     */
    public function withQuery(string $query): self
    {
        $obj = clone $this;
        $obj['query'] = $query;

        return $obj;
    }

    /**
     * AI-generated answer based on search results (for global/entity methods).
     */
    public function withResponse(string $response): self
    {
        $obj = clone $this;
        $obj['response'] = $response;

        return $obj;
    }

    /**
     * @param list<Source|array{
     *   id?: string|null,
     *   chunkCount?: int|null,
     *   createdAt?: \DateTimeInterface|null,
     *   filename?: string|null,
     *   ingestionCompletedAt?: \DateTimeInterface|null,
     *   pageCount?: int|null,
     *   textLength?: int|null,
     * }> $sources
     */
    public function withSources(array $sources): self
    {
        $obj = clone $this;
        $obj['sources'] = $sources;

        return $obj;
    }

    /**
     * ID of the searched vault.
     */
    public function withVaultID(string $vaultID): self
    {
        $obj = clone $this;
        $obj['vaultID'] = $vaultID;

        return $obj;
    }
}
