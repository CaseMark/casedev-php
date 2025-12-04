<?php

declare(strict_types=1);

namespace Casedev\Services\Voice;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Voice\V1Contract;
use Casedev\Services\Voice\V1\SpeakService;
use Casedev\Voice\V1\V1ListVoicesParams;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public SpeakService $speak;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->speak = new SpeakService($client);
    }

    /**
     * @api
     *
     * Retrieve a list of available voices for text-to-speech synthesis. This endpoint provides access to a comprehensive catalog of voices with various characteristics, languages, and styles suitable for legal document narration, client presentations, and accessibility purposes.
     *
     * @param array{
     *   category?: string,
     *   collection_id?: string,
     *   include_total_count?: bool,
     *   next_page_token?: string,
     *   page_size?: int,
     *   search?: string,
     *   sort?: 'name'|'created_at'|'updated_at',
     *   sort_direction?: 'asc'|'desc',
     *   voice_type?: 'premade'|'cloned'|'professional',
     * }|V1ListVoicesParams $params
     *
     * @throws APIException
     */
    public function listVoices(
        array|V1ListVoicesParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = V1ListVoicesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'voice/v1/voices',
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
