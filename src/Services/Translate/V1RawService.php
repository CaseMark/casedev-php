<?php

declare(strict_types=1);

namespace Casedev\Services\Translate;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Translate\V1RawContract;
use Casedev\Translate\V1\V1DetectParams;
use Casedev\Translate\V1\V1DetectResponse;
use Casedev\Translate\V1\V1ListLanguagesParams;
use Casedev\Translate\V1\V1ListLanguagesParams\Model;
use Casedev\Translate\V1\V1ListLanguagesResponse;
use Casedev\Translate\V1\V1TranslateParams;
use Casedev\Translate\V1\V1TranslateParams\Format;
use Casedev\Translate\V1\V1TranslateResponse;

/**
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1DetectParams\Q
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1TranslateParams\Q as QShape1
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Detect the language of text. Returns the most likely language code and confidence score. Supports batch detection for multiple texts.
     *
     * @param array{q: QShape}|V1DetectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DetectResponse>
     *
     * @throws APIException
     */
    public function detect(
        array|V1DetectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1DetectParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'translate/v1/detect',
            body: (object) $parsed,
            options: $options,
            convert: V1DetectResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the list of languages supported for translation. Optionally specify a target language to get translated language names.
     *
     * @param array{
     *   model?: Model|value-of<Model>, target?: string
     * }|V1ListLanguagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListLanguagesResponse>
     *
     * @throws APIException
     */
    public function listLanguages(
        array|V1ListLanguagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ListLanguagesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'translate/v1/languages',
            query: $parsed,
            options: $options,
            convert: V1ListLanguagesResponse::class,
        );
    }

    /**
     * @api
     *
     * Translate text between languages using Google Cloud Translation API. Supports 100+ languages, automatic language detection, HTML preservation, and batch translation.
     *
     * @param array{
     *   q: QShape1,
     *   target: string,
     *   format?: Format|value-of<Format>,
     *   model?: V1TranslateParams\Model|value-of<V1TranslateParams\Model>,
     *   source?: string,
     * }|V1TranslateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1TranslateResponse>
     *
     * @throws APIException
     */
    public function translate(
        array|V1TranslateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1TranslateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'translate/v1/translate',
            body: (object) $parsed,
            options: $options,
            convert: V1TranslateResponse::class,
        );
    }
}
