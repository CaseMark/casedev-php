<?php

declare(strict_types=1);

namespace CaseDev\Services;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Llm\LlmGetConfigResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\LlmRawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class LlmRawService implements LlmRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves the AI Gateway configuration including all available language models and their specifications. This endpoint returns model information compatible with the Vercel AI SDK Gateway format, making it easy to integrate with existing AI applications.
     *
     * Use this endpoint to:
     * - Discover available language models
     * - Get model specifications and pricing
     * - Configure AI SDK clients
     * - Build model selection interfaces
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LlmGetConfigResponse>
     *
     * @throws APIException
     */
    public function getConfig(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'llm/config',
            options: $requestOptions,
            convert: LlmGetConfigResponse::class,
        );
    }
}
