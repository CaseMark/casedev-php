<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveParams;
use CaseDev\Skills\SkillResolveResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SkillsRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SkillResolveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillResolveResponse>
     *
     * @throws APIException
     */
    public function resolve(
        array|SkillResolveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
