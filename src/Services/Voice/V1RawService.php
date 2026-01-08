<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\V1RawContract;
use Casedev\Voice\V1\V1ListVoicesParams;
use Casedev\Voice\V1\V1ListVoicesParams\Sort;
use Casedev\Voice\V1\V1ListVoicesParams\SortDirection;
use Casedev\Voice\V1\V1ListVoicesParams\VoiceType;

/**
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
     * Retrieve a list of available voices for text-to-speech synthesis. This endpoint provides access to a comprehensive catalog of voices with various characteristics, languages, and styles suitable for legal document narration, client presentations, and accessibility purposes.
     *
     * @param array{
     *   category?: string,
     *   collectionID?: string,
     *   includeTotalCount?: bool,
     *   nextPageToken?: string,
     *   pageSize?: int,
     *   search?: string,
     *   sort?: Sort|value-of<Sort>,
     *   sortDirection?: SortDirection|value-of<SortDirection>,
     *   voiceType?: VoiceType|value-of<VoiceType>,
     * }|V1ListVoicesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listVoices(
        array|V1ListVoicesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ListVoicesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'voice/v1/voices',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'collectionID' => 'collection_id',
                    'includeTotalCount' => 'include_total_count',
                    'nextPageToken' => 'next_page_token',
                    'pageSize' => 'page_size',
                    'sortDirection' => 'sort_direction',
                    'voiceType' => 'voice_type',
                ],
            ),
            options: $options,
            convert: null,
        );
    }
}
