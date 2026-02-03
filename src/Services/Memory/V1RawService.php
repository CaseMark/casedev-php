<?php

declare(strict_types=1);

namespace Casedev\Services\Memory;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Memory\V1\V1CreateParams;
use Casedev\Memory\V1\V1CreateParams\Message;
use Casedev\Memory\V1\V1DeleteAllParams;
use Casedev\Memory\V1\V1DeleteAllResponse;
use Casedev\Memory\V1\V1DeleteResponse;
use Casedev\Memory\V1\V1GetResponse;
use Casedev\Memory\V1\V1ListParams;
use Casedev\Memory\V1\V1ListResponse;
use Casedev\Memory\V1\V1NewResponse;
use Casedev\Memory\V1\V1SearchParams;
use Casedev\Memory\V1\V1SearchResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Memory\V1RawContract;

/**
 * @phpstan-import-type MessageShape from \Casedev\Memory\V1\V1CreateParams\Message
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
     * Store memories from conversation messages. Automatically extracts facts and handles deduplication.
     *
     * Use tag_1 through tag_12 for filtering - these are generic indexed fields you can use for any purpose:
     * - Legal app: tag_1=client_id, tag_2=matter_id
     * - Healthcare: tag_1=patient_id, tag_2=encounter_id
     * - E-commerce: tag_1=customer_id, tag_2=order_id
     *
     * @param array{
     *   messages: list<Message|MessageShape>,
     *   category?: string,
     *   extractionPrompt?: string,
     *   infer?: bool,
     *   metadata?: array<string,mixed>,
     *   tag1?: string,
     *   tag10?: string,
     *   tag11?: string,
     *   tag12?: string,
     *   tag2?: string,
     *   tag3?: string,
     *   tag4?: string,
     *   tag5?: string,
     *   tag6?: string,
     *   tag7?: string,
     *   tag8?: string,
     *   tag9?: string,
     * }|V1CreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1NewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'memory/v1',
            body: (object) $parsed,
            options: $options,
            convert: V1NewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a single memory by its ID.
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['memory/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1GetResponse::class,
        );
    }

    /**
     * @api
     *
     * List all memories with optional filtering by tags and category.
     *
     * @param array{
     *   category?: string,
     *   limit?: int,
     *   offset?: int,
     *   tag1?: string,
     *   tag10?: string,
     *   tag11?: string,
     *   tag12?: string,
     *   tag2?: string,
     *   tag3?: string,
     *   tag4?: string,
     *   tag5?: string,
     *   tag6?: string,
     *   tag7?: string,
     *   tag8?: string,
     *   tag9?: string,
     * }|V1ListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|V1ListParams $params,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = V1ListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'memory/v1',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'tag1' => 'tag_1',
                    'tag10' => 'tag_10',
                    'tag11' => 'tag_11',
                    'tag12' => 'tag_12',
                    'tag2' => 'tag_2',
                    'tag3' => 'tag_3',
                    'tag4' => 'tag_4',
                    'tag5' => 'tag_5',
                    'tag6' => 'tag_6',
                    'tag7' => 'tag_7',
                    'tag8' => 'tag_8',
                    'tag9' => 'tag_9',
                ],
            ),
            options: $options,
            convert: V1ListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a single memory by its ID.
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['memory/v1/%1$s', $id],
            options: $requestOptions,
            convert: V1DeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete multiple memories matching tag filter criteria. CAUTION: This will delete all matching memories for your organization.
     *
     * @param array{
     *   tag1?: string,
     *   tag10?: string,
     *   tag11?: string,
     *   tag12?: string,
     *   tag2?: string,
     *   tag3?: string,
     *   tag4?: string,
     *   tag5?: string,
     *   tag6?: string,
     *   tag7?: string,
     *   tag8?: string,
     *   tag9?: string,
     * }|V1DeleteAllParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteAllResponse>
     *
     * @throws APIException
     */
    public function deleteAll(
        array|V1DeleteAllParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1DeleteAllParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: 'memory/v1',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'tag1' => 'tag_1',
                    'tag10' => 'tag_10',
                    'tag11' => 'tag_11',
                    'tag12' => 'tag_12',
                    'tag2' => 'tag_2',
                    'tag3' => 'tag_3',
                    'tag4' => 'tag_4',
                    'tag5' => 'tag_5',
                    'tag6' => 'tag_6',
                    'tag7' => 'tag_7',
                    'tag8' => 'tag_8',
                    'tag9' => 'tag_9',
                ],
            ),
            options: $options,
            convert: V1DeleteAllResponse::class,
        );
    }

    /**
     * @api
     *
     * Search memories using semantic similarity. Filter by tag fields to narrow results.
     *
     * Use tag_1 through tag_12 for filtering - these are generic indexed fields you define:
     * - Legal app: tag_1=client_id, tag_2=matter_id
     * - Healthcare: tag_1=patient_id, tag_2=encounter_id
     *
     * @param array{
     *   query: string,
     *   category?: string,
     *   tag1?: string,
     *   tag10?: string,
     *   tag11?: string,
     *   tag12?: string,
     *   tag2?: string,
     *   tag3?: string,
     *   tag4?: string,
     *   tag5?: string,
     *   tag6?: string,
     *   tag7?: string,
     *   tag8?: string,
     *   tag9?: string,
     *   topK?: int,
     * }|V1SearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1SearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|V1SearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1SearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'memory/v1/search',
            body: (object) $parsed,
            options: $options,
            convert: V1SearchResponse::class,
        );
    }
}
