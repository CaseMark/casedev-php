<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\SkillsRawContract;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveParams;
use CaseDev\Skills\SkillResolveResponse;

/**
 * Search and read legal AI skills for agents.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SkillsRawService implements SkillsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Read the full content of a legal skill by its slug. Returns markdown content, tags, and metadata.
     *
     * @param string $slug Unique skill slug identifier
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillReadResponse>
     *
     * @throws APIException
     */
    public function read(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['skills/%1$s', $slug],
            options: $requestOptions,
            convert: SkillReadResponse::class,
        );
    }

    /**
     * @api
     *
     * Search the Legal Skills Store using hybrid search (text + tag + semantic). Returns ranked results with relevance scores.
     *
     * @param array{q: string, limit?: int}|SkillResolveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillResolveResponse>
     *
     * @throws APIException
     */
    public function resolve(
        array|SkillResolveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SkillResolveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'skills/resolve',
            query: $parsed,
            options: $options,
            convert: SkillResolveResponse::class,
        );
    }
}
