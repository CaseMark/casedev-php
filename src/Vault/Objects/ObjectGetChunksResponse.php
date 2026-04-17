<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Objects\ObjectGetChunksResponse\Chunk;

/**
 * @phpstan-import-type ChunkShape from \CaseDev\Vault\Objects\ObjectGetChunksResponse\Chunk
 *
 * @phpstan-type ObjectGetChunksResponseShape = array{
 *   chunks: list<Chunk|ChunkShape>,
 *   objectID: string,
 *   totalChunks: int,
 *   vaultID: string,
 * }
 */
final class ObjectGetChunksResponse implements BaseModel
{
    /** @use SdkModel<ObjectGetChunksResponseShape> */
    use SdkModel;

    /**
     * Full chunk objects for the requested range.
     *
     * @var list<Chunk> $chunks
     */
    #[Required(list: Chunk::class)]
    public array $chunks;

    /**
     * The object ID.
     */
    #[Required('object_id')]
    public string $objectID;

    /**
     * Total number of chunks stored for the object.
     */
    #[Required('total_chunks')]
    public int $totalChunks;

    /**
     * The vault ID.
     */
    #[Required('vault_id')]
    public string $vaultID;

    /**
     * `new ObjectGetChunksResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectGetChunksResponse::with(
     *   chunks: ..., objectID: ..., totalChunks: ..., vaultID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectGetChunksResponse)
     *   ->withChunks(...)
     *   ->withObjectID(...)
     *   ->withTotalChunks(...)
     *   ->withVaultID(...)
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
     *
     * @param list<Chunk|ChunkShape> $chunks
     */
    public static function with(
        array $chunks,
        string $objectID,
        int $totalChunks,
        string $vaultID
    ): self {
        $self = new self;

        $self['chunks'] = $chunks;
        $self['objectID'] = $objectID;
        $self['totalChunks'] = $totalChunks;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Full chunk objects for the requested range.
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
     * The object ID.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Total number of chunks stored for the object.
     */
    public function withTotalChunks(int $totalChunks): self
    {
        $self = clone $this;
        $self['totalChunks'] = $totalChunks;

        return $self;
    }

    /**
     * The vault ID.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }
}
