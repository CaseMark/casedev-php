<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\GraphragRawContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class GraphragRawService implements GraphragRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve GraphRAG (Graph Retrieval-Augmented Generation) statistics for a specific vault. This includes metrics about the knowledge graph structure, entity relationships, and processing status that enable advanced semantic search and AI-powered document analysis.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['vault/%1$s/graphrag/stats', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Initialize a GraphRAG workspace for a vault to enable advanced knowledge graph and retrieval-augmented generation capabilities. This creates the necessary infrastructure for semantic document analysis and graph-based querying within the vault.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function init(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['vault/%1$s/graphrag/init', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
