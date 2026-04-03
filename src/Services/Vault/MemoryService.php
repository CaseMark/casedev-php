<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\MemoryContract;
use CaseDev\Vault\Memory\MemoryCreateParams\Type;
use CaseDev\Vault\Memory\MemoryListResponse;
use CaseDev\Vault\Memory\MemoryNewResponse;
use CaseDev\Vault\Memory\MemorySearchResponse;

/**
 * Secure document storage with semantic search and GraphRAG.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MemoryService implements MemoryContract
{
    /**
     * @api
     */
    public MemoryRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MemoryRawService($client);
    }

    /**
     * @api
     *
     * Append a new file-backed memory entry to a vault.
     *
     * @param string $id Vault ID
     * @param Type|value-of<Type> $type
     * @param list<string> $tags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $content,
        Type|string $type,
        ?string $source = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): MemoryNewResponse {
        $params = Util::removeNulls(
            [
                'content' => $content,
                'type' => $type,
                'source' => $source,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Rewrite a file-backed vault memory entry with updated content, source, or tags.
     *
     * @param string $entryID Path param: Memory entry ID
     * @param string $id Path param: Vault ID
     * @param string $content Body param
     * @param string|null $source Body param
     * @param list<string> $tags Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $entryID,
        string $id,
        ?string $content = null,
        ?string $source = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['id' => $id, 'content' => $content, 'source' => $source, 'tags' => $tags]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($entryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve file-backed memory entries stored in a vault.
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): MemoryListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a file-backed memory entry from a vault.
     *
     * @param string $entryID Memory entry ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($entryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search file-backed vault memory using simple full-text matching over content and tags.
     *
     * @param string $id Vault ID
     * @param list<string> $tags
     * @param list<string> $types
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $id,
        string $query,
        int $limit = 10,
        ?array $tags = null,
        ?array $types = null,
        RequestOptions|array|null $requestOptions = null,
    ): MemorySearchResponse {
        $params = Util::removeNulls(
            ['query' => $query, 'limit' => $limit, 'tags' => $tags, 'types' => $types]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
