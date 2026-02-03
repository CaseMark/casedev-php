<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Translate;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Translate\V1\V1DetectResponse;
use Casedev\Translate\V1\V1ListLanguagesParams\Model;
use Casedev\Translate\V1\V1ListLanguagesResponse;
use Casedev\Translate\V1\V1TranslateParams\Format;
use Casedev\Translate\V1\V1TranslateResponse;

/**
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1DetectParams\Q
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1TranslateParams\Q as QShape1
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param QShape $q Text to detect language for. Can be a single string or an array for batch detection.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function detect(
        string|array $q,
        RequestOptions|array|null $requestOptions = null
    ): V1DetectResponse;

    /**
     * @api
     *
     * @param Model|value-of<Model> $model Translation model to check language support for
     * @param string $target Target language code for translating language names (e.g., 'es' for Spanish names)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listLanguages(
        Model|string|null $model = null,
        ?string $target = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ListLanguagesResponse;

    /**
     * @api
     *
     * @param QShape1 $q Text to translate. Can be a single string or an array for batch translation.
     * @param string $target Target language code (ISO 639-1)
     * @param Format|value-of<Format> $format Format of the source text. Use 'html' to preserve HTML tags.
     * @param \Casedev\Translate\V1\V1TranslateParams\Model|value-of<\Casedev\Translate\V1\V1TranslateParams\Model> $model Translation model. 'nmt' (Neural Machine Translation) is recommended for quality.
     * @param string $source Source language code (ISO 639-1). If not specified, language is auto-detected.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function translate(
        string|array $q,
        string $target,
        Format|string $format = 'text',
        \Casedev\Translate\V1\V1TranslateParams\Model|string $model = 'nmt',
        ?string $source = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1TranslateResponse;
}
