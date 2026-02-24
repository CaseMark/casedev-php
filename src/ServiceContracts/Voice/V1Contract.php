<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Voice;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Voice\V1\V1ListVoicesParams\Sort;
use CaseDev\Voice\V1\V1ListVoicesParams\SortDirection;
use CaseDev\Voice\V1\V1ListVoicesParams\VoiceType;
use CaseDev\Voice\V1\V1ListVoicesResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
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
    ): V1ListVoicesResponse;
}
