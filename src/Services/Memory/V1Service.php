<?php

declare(strict_types=1);

namespace Casedev\Services\Memory;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Memory\V1\V1CreateParams\Message;
use Casedev\Memory\V1\V1DeleteAllResponse;
use Casedev\Memory\V1\V1DeleteResponse;
use Casedev\Memory\V1\V1GetResponse;
use Casedev\Memory\V1\V1ListResponse;
use Casedev\Memory\V1\V1NewResponse;
use Casedev\Memory\V1\V1SearchResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Memory\V1Contract;

/**
 * @phpstan-import-type MessageShape from \Casedev\Memory\V1\V1CreateParams\Message
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

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
    ): V1NewResponse {
        $params = Util::removeNulls(
            [
                'messages' => $messages,
                'category' => $category,
                'extractionPrompt' => $extractionPrompt,
                'infer' => $infer,
                'metadata' => $metadata,
                'tag1' => $tag1,
                'tag10' => $tag10,
                'tag11' => $tag11,
                'tag12' => $tag12,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'tag4' => $tag4,
                'tag5' => $tag5,
                'tag6' => $tag6,
                'tag7' => $tag7,
                'tag8' => $tag8,
                'tag9' => $tag9,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a single memory by its ID.
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1GetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all memories with optional filtering by tags and category.
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
    ): V1ListResponse {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'limit' => $limit,
                'offset' => $offset,
                'tag1' => $tag1,
                'tag10' => $tag10,
                'tag11' => $tag11,
                'tag12' => $tag12,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'tag4' => $tag4,
                'tag5' => $tag5,
                'tag6' => $tag6,
                'tag7' => $tag7,
                'tag8' => $tag8,
                'tag9' => $tag9,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a single memory by its ID.
     *
     * @param string $id Memory ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): V1DeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete multiple memories matching tag filter criteria. CAUTION: This will delete all matching memories for your organization.
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
    ): V1DeleteAllResponse {
        $params = Util::removeNulls(
            [
                'tag1' => $tag1,
                'tag10' => $tag10,
                'tag11' => $tag11,
                'tag12' => $tag12,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'tag4' => $tag4,
                'tag5' => $tag5,
                'tag6' => $tag6,
                'tag7' => $tag7,
                'tag8' => $tag8,
                'tag9' => $tag9,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteAll(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
    ): V1SearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'category' => $category,
                'tag1' => $tag1,
                'tag10' => $tag10,
                'tag11' => $tag11,
                'tag12' => $tag12,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'tag4' => $tag4,
                'tag5' => $tag5,
                'tag6' => $tag6,
                'tag7' => $tag7,
                'tag8' => $tag8,
                'tag9' => $tag9,
                'topK' => $topK,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
