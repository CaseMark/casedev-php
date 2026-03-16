<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Skills\SkillCreateParams;
use CaseDev\Skills\SkillDeleteResponse;
use CaseDev\Skills\SkillNewResponse;
use CaseDev\Skills\SkillReadResponse;
use CaseDev\Skills\SkillResolveParams;
use CaseDev\Skills\SkillResolveResponse;
use CaseDev\Skills\SkillUpdateParams;
use CaseDev\Skills\SkillUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SkillsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SkillCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkillNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|SkillCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $slug_ Skill slug to update
     * @param array<string,mixed>|SkillUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

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
