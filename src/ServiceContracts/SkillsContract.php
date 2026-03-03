<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SkillsContract
{
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
