<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Translate;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Translate\V1\V1DetectParams;
use Casedev\Translate\V1\V1DetectResponse;
use Casedev\Translate\V1\V1ListLanguagesParams;
use Casedev\Translate\V1\V1ListLanguagesResponse;
use Casedev\Translate\V1\V1TranslateParams;
use Casedev\Translate\V1\V1TranslateResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|V1DetectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DetectResponse>
     *
     * @throws APIException
     */
    public function detect(
        array|V1DetectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ListLanguagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListLanguagesResponse>
     *
     * @throws APIException
     */
    public function listLanguages(
        array|V1ListLanguagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1TranslateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1TranslateResponse>
     *
     * @throws APIException
     */
    public function translate(
        array|V1TranslateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
