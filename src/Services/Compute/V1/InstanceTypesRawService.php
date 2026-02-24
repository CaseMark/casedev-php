<?php

declare(strict_types=1);

namespace CaseDev\Services\Compute\V1;

use CaseDev\Client;
use CaseDev\Compute\V1\InstanceTypes\InstanceTypeListResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Compute\V1\InstanceTypesRawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class InstanceTypesRawService implements InstanceTypesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves all available GPU instance types with pricing, specifications, and regional availability. Includes T4, A10, A100, H100, and H200 GPUs powered by Lambda Labs. Perfect for AI model training, inference workloads, and legal document OCR processing at scale.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InstanceTypeListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'compute/v1/instance-types',
            options: $requestOptions,
            convert: InstanceTypeListResponse::class,
        );
    }
}
