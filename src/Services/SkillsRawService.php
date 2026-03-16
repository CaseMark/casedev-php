<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\SkillsRawContract;
use CaseDev\Skills\SkillCreateParams;
use CaseDev\Skills\SkillDeleteResponse;
use CaseDev\Skills\SkillNewResponse;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveParams;
use CaseDev\Skills\SkillResolveResponse;
use CaseDev\Skills\SkillUpdateParams;
use CaseDev\Skills\SkillUpdateResponse;

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
     * Create an org-scoped custom skill. The skill will be searchable via /skills/resolve alongside curated skills.
     *
     * @param array{
     *   content: string,
     *   name: string,
     *   metadata?: mixed,
     *   slug?: string,
     *   summary?: string,
     *   tags?: list<string>,
     * }|SkillCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SkillCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SkillCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'skills',
            body: (object) $parsed,
            options: $options,
            convert: SkillNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Update an org-scoped custom skill by slug. Only provided fields are updated. Version is auto-incremented.
     *
     * @param string $slug_ Skill slug to update
     * @param array{
     *   content?: string,
     *   metadata?: mixed,
     *   name?: string,
     *   slug?: string,
     *   summary?: string|null,
     *   tags?: list<string>,
     * }|SkillUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $slug_,
        array|SkillUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SkillUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['skills/%1$s', $slug_],
            body: (object) $parsed,
            options: $options,
            convert: SkillUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Soft-delete an org-scoped custom skill by slug. The skill will no longer appear in search results.
     *
     * @param string $slug Skill slug to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['skills/%1$s', $slug],
            options: $requestOptions,
            convert: SkillDeleteResponse::class,
        );
    }

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
