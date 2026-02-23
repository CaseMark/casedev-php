<?php

declare(strict_types=1);

namespace Router\Services;

use Router\Client;
use Router\Core\Contracts\BaseResponse;
use Router\Core\Exceptions\APIException;
use Router\RequestOptions;
use Router\ServiceContracts\SystemRawContract;
use Router\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Router\RequestOptions
 */
final class SystemRawService implements SystemRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the public Case.dev services catalog derived from docs.case.dev/services. This endpoint is unauthenticated and intended for discovery surfaces such as the case.dev homepage.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SystemListServicesResponse>
     *
     * @throws APIException
     */
    public function listServices(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'services',
            options: $requestOptions,
            convert: SystemListServicesResponse::class,
        );
    }
}
