<?php

declare(strict_types=1);

namespace Casedev\Services;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\LlmContract;
use Casedev\Services\Llm\V1Service;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class LlmService implements LlmContract
{
    /**
     * @api
     */
    public LlmRawService $raw;

    /**
     * @api
     */
    public V1Service $v1;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LlmRawService($client);
        $this->v1 = new V1Service($client);
    }

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
     * @throws APIException
     */
    public function getConfig(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getConfig(requestOptions: $requestOptions);

        return $response->parse();
    }
}
