<?php

declare(strict_types=1);

namespace Casedev\Services\Compute\V1;

use Casedev\Client;
use Casedev\Compute\V1\InstanceTypes\InstanceTypeListResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Compute\V1\InstanceTypesContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
