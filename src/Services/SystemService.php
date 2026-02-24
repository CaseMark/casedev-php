<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\SystemContract;
use CaseDev\System\SystemListServicesResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class SystemService implements SystemContract
{
    /**
     * @api
     */
    public SystemRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SystemRawService($client);
    }

    /**
     * @api
     *
     * Returns the public Case.dev services catalog derived from docs.case.dev/services. This endpoint is unauthenticated and intended for discovery surfaces such as the case.dev homepage.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listServices(
        RequestOptions|array|null $requestOptions = null
    ): SystemListServicesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listServices(requestOptions: $requestOptions);

        return $response->parse();
    }
}
