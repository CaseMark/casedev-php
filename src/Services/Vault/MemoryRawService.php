<?php

declare(strict_types=1);

namespace CaseDev\Services\Vault;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Vault\MemoryRawContract;
use CaseDev\Vault\Memory\MemoryCreateParams;
use CaseDev\Vault\Memory\MemoryCreateParams\Type;
use CaseDev\Vault\Memory\MemoryDeleteParams;
use CaseDev\Vault\Memory\MemoryListResponse;
use CaseDev\Vault\Memory\MemoryNewResponse;
use CaseDev\Vault\Memory\MemorySearchParams;
use CaseDev\Vault\Memory\MemorySearchResponse;
use CaseDev\Vault\Memory\MemoryUpdateParams;

/**
 * Secure document storage with semantic search and GraphRAG.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MemoryRawService implements MemoryRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Append a new file-backed memory entry to a vault.
     *
     * @param string $id Vault ID
     * @param array{
     *   content: string,
     *   type: Type|value-of<Type>,
     *   source?: string,
     *   tags?: list<string>,
     * }|MemoryCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemoryNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|MemoryCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MemoryCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/memory', $id],
            body: (object) $parsed,
            options: $options,
            convert: MemoryNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Rewrite a file-backed vault memory entry with updated content, source, or tags.
     *
     * @param string $entryID Path param: Memory entry ID
     * @param array{
     *   id: string, content?: string, source?: string|null, tags?: list<string>
     * }|MemoryUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $entryID,
        array|MemoryUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MemoryUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['vault/%1$s/memory/%2$s', $id, $entryID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve file-backed memory entries stored in a vault.
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemoryListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/memory', $id],
            options: $requestOptions,
            convert: MemoryListResponse::class,
        );
    }

    /**
     * @api
     *
     * Remove a file-backed memory entry from a vault.
     *
     * @param string $entryID Memory entry ID
     * @param array{id: string}|MemoryDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        array|MemoryDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MemoryDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['vault/%1$s/memory/%2$s', $id, $entryID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Search file-backed vault memory using simple full-text matching over content and tags.
     *
     * @param string $id Vault ID
     * @param array{
     *   query: string, limit?: int, tags?: list<string>, types?: list<string>
     * }|MemorySearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MemorySearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $id,
        array|MemorySearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MemorySearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/memory/search', $id],
            body: (object) $parsed,
            options: $options,
            convert: MemorySearchResponse::class,
        );
    }
}
