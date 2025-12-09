<?php

declare(strict_types=1);

namespace Casedev\Vault;

use Casedev\Core\Attributes\Api;
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
 *   vault_id?: string|null,
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
    #[Api(list: Chunk::class, optional: true)]
    public ?array $chunks;

    /**
     * Search method used.
     */
    #[Api(optional: true)]
    public ?string $method;

    /**
     * Original search query.
     */
    #[Api(optional: true)]
    public ?string $query;

    /**
     * AI-generated answer based on search results (for global/entity methods).
     */
    #[Api(optional: true)]
    public ?string $response;

    /** @var list<Source>|null $sources */
    #[Api(list: Source::class, optional: true)]
    public ?array $sources;

    /**
     * ID of the searched vault.
     */
    #[Api(optional: true)]
    public ?string $vault_id;

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
        ?string $vault_id = null,
    ): self {
        $obj = new self;

        null !== $chunks && $obj['chunks'] = $chunks;
        null !== $method && $obj['method'] = $method;
        null !== $query && $obj['query'] = $query;
        null !== $response && $obj['response'] = $response;
        null !== $sources && $obj['sources'] = $sources;
        null !== $vault_id && $obj['vault_id'] = $vault_id;

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
        $obj['vault_id'] = $vaultID;

        return $obj;
    }
}
