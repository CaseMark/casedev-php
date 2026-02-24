<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Memory;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Memory\V1\V1CreateParams\Message;
use CaseDev\Memory\V1\V1DeleteAllResponse;
use CaseDev\Memory\V1\V1DeleteResponse;
use CaseDev\Memory\V1\V1GetResponse;
use CaseDev\Memory\V1\V1ListResponse;
use CaseDev\Memory\V1\V1NewResponse;
use CaseDev\Memory\V1\V1SearchResponse;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type MessageShape from \CaseDev\Memory\V1\V1CreateParams\Message
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param list<Message|MessageShape> $messages Conversation messages to extract memories from
     * @param string $category Custom category (e.g., "fact", "preference", "deadline")
     * @param string $extractionPrompt Optional custom prompt for fact extraction
     * @param bool $infer Whether to extract facts from messages (default: true)
     * @param array<string,mixed> $metadata Additional metadata (not indexed)
     * @param string $tag1 Generic indexed filter field 1 (you decide what it means)
     * @param string $tag10 Generic indexed filter field 10
     * @param string $tag11 Generic indexed filter field 11
     * @param string $tag12 Generic indexed filter field 12
     * @param string $tag2 Generic indexed filter field 2
     * @param string $tag3 Generic indexed filter field 3
     * @param string $tag4 Generic indexed filter field 4
     * @param string $tag5 Generic indexed filter field 5
     * @param string $tag6 Generic indexed filter field 6
     * @param string $tag7 Generic indexed filter field 7
     * @param string $tag8 Generic indexed filter field 8
     * @param string $tag9 Generic indexed filter field 9
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $messages,
        ?string $category = null,
        ?string $extractionPrompt = null,
        bool $infer = true,
        ?array $metadata = null,
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1NewResponse;

    /**
     * @api
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetResponse;

    /**
     * @api
     *
     * @param string $category Filter by category
     * @param int $limit Number of results
     * @param int $offset Pagination offset
     * @param string $tag1 Filter by tag_1
     * @param string $tag10 Filter by tag_10
     * @param string $tag11 Filter by tag_11
     * @param string $tag12 Filter by tag_12
     * @param string $tag2 Filter by tag_2
     * @param string $tag3 Filter by tag_3
     * @param string $tag4 Filter by tag_4
     * @param string $tag5 Filter by tag_5
     * @param string $tag6 Filter by tag_6
     * @param string $tag7 Filter by tag_7
     * @param string $tag8 Filter by tag_8
     * @param string $tag9 Filter by tag_9
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $category = null,
        int $limit = 50,
        int $offset = 0,
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ListResponse;

    /**
     * @api
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1DeleteResponse;

    /**
     * @api
     *
     * @param string $tag1 Filter by tag_1
     * @param string $tag10 Filter by tag_10
     * @param string $tag11 Filter by tag_11
     * @param string $tag12 Filter by tag_12
     * @param string $tag2 Filter by tag_2
     * @param string $tag3 Filter by tag_3
     * @param string $tag4 Filter by tag_4
     * @param string $tag5 Filter by tag_5
     * @param string $tag6 Filter by tag_6
     * @param string $tag7 Filter by tag_7
     * @param string $tag8 Filter by tag_8
     * @param string $tag9 Filter by tag_9
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteAll(
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1DeleteAllResponse;

    /**
     * @api
     *
     * @param string $query Search query for semantic matching
     * @param string $category Filter by category
     * @param string $tag1 Filter by tag_1
     * @param string $tag10 Filter by tag_10
     * @param string $tag11 Filter by tag_11
     * @param string $tag12 Filter by tag_12
     * @param string $tag2 Filter by tag_2
     * @param string $tag3 Filter by tag_3
     * @param string $tag4 Filter by tag_4
     * @param string $tag5 Filter by tag_5
     * @param string $tag6 Filter by tag_6
     * @param string $tag7 Filter by tag_7
     * @param string $tag8 Filter by tag_8
     * @param string $tag9 Filter by tag_9
     * @param int $topK Maximum number of results to return
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $category = null,
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
        int $topK = 10,
        RequestOptions|array|null $requestOptions = null,
    ): V1SearchResponse;
}
