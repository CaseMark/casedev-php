<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\SkillDeleteResponse;
use CaseDev\Skills\SkillNewResponse;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveResponse;
use CaseDev\Skills\SkillUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SkillsContract
{
    /**
     * @api
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
    ): SkillNewResponse;

    /**
     * @api
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
    ): SkillUpdateResponse;

    /**
     * @api
     *
     * @param string $slug Skill slug to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): SkillDeleteResponse;

    /**
     * @api
     *
     * @param string $slug Unique skill slug identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function read(
        string $slug,
        RequestOptions|array|null $requestOptions = null
    ): SkillReadResponse;

    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): SkillResolveResponse;
}
