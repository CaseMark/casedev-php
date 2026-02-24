<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Translate;

use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Translate\V1\V1DetectParams;
use CaseDev\Translate\V1\V1DetectResponse;
use CaseDev\Translate\V1\V1ListLanguagesParams;
use CaseDev\Translate\V1\V1ListLanguagesResponse;
use CaseDev\Translate\V1\V1TranslateParams;
use CaseDev\Translate\V1\V1TranslateResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
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
