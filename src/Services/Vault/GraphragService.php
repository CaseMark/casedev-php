<?php

declare(strict_types=1);

namespace Casedev\Services\Vault;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Vault\GraphragContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
    ): mixed {
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
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->init($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
