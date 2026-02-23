<?php

declare(strict_types=1);

namespace Router\Services\Vault;

use Router\Client;
use Router\Core\Exceptions\APIException;
use Router\Core\Util;
use Router\RequestOptions;
use Router\ServiceContracts\Vault\GraphragContract;
use Router\Vault\Graphrag\GraphragGetStatsResponse;
use Router\Vault\Graphrag\GraphragInitResponse;
use Router\Vault\Graphrag\GraphragProcessObjectResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class GraphragService implements GraphragContract
{
    /**
     * @api
     */
    public GraphragRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GraphragRawService($client);
    }

    /**
     * @api
     *
     * Retrieve GraphRAG (Graph Retrieval-Augmented Generation) statistics for a specific vault. This includes metrics about the knowledge graph structure, entity relationships, and processing status that enable advanced semantic search and AI-powered document analysis.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStats(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): GraphragGetStatsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStats($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Initialize a GraphRAG workspace for a vault to enable advanced knowledge graph and retrieval-augmented generation capabilities. This creates the necessary infrastructure for semantic document analysis and graph-based querying within the vault.
     *
     * @param string $id The unique identifier of the vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function init(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): GraphragInitResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->init($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Manually trigger GraphRAG indexing for a vault object. The object must already be ingested (completed status). This extracts entities, relationships, and communities from the document for advanced knowledge graph queries.
     *
     * @param string $objectID Vault object ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function processObject(
        string $objectID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): GraphragProcessObjectResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->processObject($objectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
