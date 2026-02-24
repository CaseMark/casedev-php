<?php

declare(strict_types=1);

namespace CaseDev\Services\Compute\V1;

use CaseDev\Client;
use CaseDev\Compute\V1\InstanceTypes\InstanceTypeListResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Compute\V1\InstanceTypesContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class InstanceTypesService implements InstanceTypesContract
{
    /**
     * @api
     */
    public InstanceTypesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InstanceTypesRawService($client);
    }

    /**
     * @api
     *
     * Retrieves all available GPU instance types with pricing, specifications, and regional availability. Includes T4, A10, A100, H100, and H200 GPUs powered by Lambda Labs. Perfect for AI model training, inference workloads, and legal document OCR processing at scale.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): InstanceTypeListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }
}
