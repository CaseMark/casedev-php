<?php

declare(strict_types=1);

namespace CaseDev\Services\Voice;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Voice\BoostListRawContract;
use CaseDev\Voice\BoostList\BoostListExtractParams;
use CaseDev\Voice\BoostList\BoostListExtractParams\Category;
use CaseDev\Voice\BoostList\BoostListExtractResponse;
use CaseDev\Voice\BoostList\BoostListGenerateParams;
use CaseDev\Voice\BoostList\BoostListGenerateResponse;

/**
 * Audio transcription and text-to-speech.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class BoostListRawService implements BoostListRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Extracts a categorized word boost list from vault documents or raw text using LLM entity extraction. The resulting list can be passed as `word_boost` to the transcription endpoint for improved accuracy.
     *
     * @param array{
     *   categories?: list<Category|value-of<Category>>,
     *   objectIDs?: list<string>,
     *   text?: string,
     *   vaultID?: string,
     * }|BoostListExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BoostListExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        array|BoostListExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BoostListExtractParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'voice/boost-list/extract',
            body: (object) $parsed,
            options: $options,
            convert: BoostListExtractResponse::class,
        );
    }

    /**
     * @api
     *
     * Generates a categorized word boost list from a completed transcription job. Extracts entities from the pass-1 transcript for use as `word_boost` in a second transcription pass.
     *
     * @param array{
     *   transcriptionJobID: string,
     *   categories?: list<BoostListGenerateParams\Category|value-of<BoostListGenerateParams\Category>>,
     * }|BoostListGenerateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BoostListGenerateResponse>
     *
     * @throws APIException
     */
    public function generate(
        array|BoostListGenerateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BoostListGenerateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'voice/boost-list/generate',
            body: (object) $parsed,
            options: $options,
            convert: BoostListGenerateResponse::class,
        );
    }
}
