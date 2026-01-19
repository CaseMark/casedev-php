<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\V1Contract;
use Casedev\Services\Voice\V1\SpeakService;
use Casedev\Voice\V1\V1ListVoicesParams\Sort;
use Casedev\Voice\V1\V1ListVoicesParams\SortDirection;
use Casedev\Voice\V1\V1ListVoicesParams\VoiceType;
use Casedev\Voice\V1\V1ListVoicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public SpeakService $speak;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->speak = new SpeakService($client);
    }

    /**
     * @api
     *
     * Retrieve a list of available voices for text-to-speech synthesis. This endpoint provides access to a comprehensive catalog of voices with various characteristics, languages, and styles suitable for legal document narration, client presentations, and accessibility purposes.
     *
     * @param string $category Filter by voice category
     * @param string $collectionID Filter by voice collection ID
     * @param bool $includeTotalCount Whether to include total count in response
     * @param string $nextPageToken Token for retrieving the next page of results
     * @param int $pageSize Number of voices to return per page (max 100)
     * @param string $search Search term to filter voices by name or description
     * @param Sort|value-of<Sort> $sort Field to sort by
     * @param SortDirection|value-of<SortDirection> $sortDirection Sort direction
     * @param VoiceType|value-of<VoiceType> $voiceType Filter by voice type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listVoices(
        ?string $category = null,
        ?string $collectionID = null,
        bool $includeTotalCount = false,
        ?string $nextPageToken = null,
        int $pageSize = 50,
        ?string $search = null,
        Sort|string|null $sort = null,
        SortDirection|string $sortDirection = 'asc',
        VoiceType|string|null $voiceType = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ListVoicesResponse {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'collectionID' => $collectionID,
                'includeTotalCount' => $includeTotalCount,
                'nextPageToken' => $nextPageToken,
                'pageSize' => $pageSize,
                'search' => $search,
                'sort' => $sort,
                'sortDirection' => $sortDirection,
                'voiceType' => $voiceType,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listVoices(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
