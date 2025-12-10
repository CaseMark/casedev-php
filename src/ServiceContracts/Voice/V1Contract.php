<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Voice;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\Voice\V1\V1ListVoicesParams\Sort;
use Casedev\Voice\V1\V1ListVoicesParams\SortDirection;
use Casedev\Voice\V1\V1ListVoicesParams\VoiceType;

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
     * @param 'name'|'created_at'|'updated_at'|Sort $sort Field to sort by
     * @param 'asc'|'desc'|SortDirection $sortDirection Sort direction
     * @param 'premade'|'cloned'|'professional'|VoiceType $voiceType Filter by voice type
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
        string|Sort|null $sort = null,
        string|SortDirection $sortDirection = 'asc',
        string|VoiceType|null $voiceType = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
