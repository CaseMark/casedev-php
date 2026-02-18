<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\SystemRawContract;
use Casedev\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
