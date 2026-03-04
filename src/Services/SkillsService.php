<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\SkillsContract;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveResponse;

/**
 * Search and read legal AI skills for agents.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SkillsService implements SkillsContract
{
    /**
     * @api
     */
    public SkillsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SkillsRawService($client);
    }

    /**
     * @api
     *
     * Read the full content of a legal skill by its slug. Returns markdown content, tags, and metadata.
     *
     * @param string $slug Unique skill slug identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function read(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): SkillReadResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->read($slug, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search the Legal Skills Store using hybrid search (text + tag + semantic). Returns ranked results with relevance scores.
     *
     * @param string $q Search query string
     * @param int $limit Maximum number of results to return (1-20)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resolve(
        string $q,
        int $limit = 10,
        RequestOptions|array|null $requestOptions = null
    ): SkillResolveResponse {
        $params = Util::removeNulls(['q' => $q, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resolve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
