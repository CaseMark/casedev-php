<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\SkillsContract;
use CaseDev\Services\Skills\CustomService;
use CaseDev\Skills\SkillDeleteResponse;
use CaseDev\Skills\SkillNewResponse;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveResponse;
use CaseDev\Skills\SkillUpdateResponse;

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
     * @api
     */
    public CustomService $custom;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SkillsRawService($client);
        $this->custom = new CustomService($client);
    }

    /**
     * @api
     *
     * Create an org-scoped custom skill. The skill will be searchable via /skills/resolve alongside curated skills.
     *
     * @param string $content Full skill content in markdown
     * @param string $name Skill name
     * @param mixed $metadata Arbitrary metadata (author, license, etc.)
     * @param string $slug URL-safe slug. Auto-generated from name if omitted.
     * @param string $summary Brief description (1-2 sentences)
     * @param list<string> $tags Tags for categorization and search boosting
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $content,
        string $name,
        mixed $metadata = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkillNewResponse {
        $params = Util::removeNulls(
            [
                'content' => $content,
                'name' => $name,
                'metadata' => $metadata,
                'slug' => $slug,
                'summary' => $summary,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an org-scoped custom skill by slug. Only provided fields are updated. Version is auto-incremented.
     *
     * @param string $slug_ Skill slug to update
     * @param string $slug New slug (renames the skill)
     * @param list<string> $tags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $slug_,
        ?string $content = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $slug = null,
        ?string $summary = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkillUpdateResponse {
        $params = Util::removeNulls(
            [
                'content' => $content,
                'metadata' => $metadata,
                'name' => $name,
                'slug' => $slug,
                'summary' => $summary,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($slug_, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Soft-delete an org-scoped custom skill by slug. The skill will no longer appear in search results.
     *
     * @param string $slug Skill slug to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): SkillDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($slug, requestOptions: $requestOptions);

        return $response->parse();
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
