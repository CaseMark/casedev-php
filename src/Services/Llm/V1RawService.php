<?php

declare(strict_types=1);

namespace Casedev\Services\Llm;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Llm\V1RawContract;

/**
 * @phpstan-import-type InputShape from \Casedev\Llm\V1\V1CreateEmbeddingParams\Input
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create vector embeddings from text using OpenAI-compatible models. Perfect for semantic search, document similarity, and building RAG systems for legal documents.
     *
     * @param array{
     *   input: InputShape,
     *   model: string,
     *   dimensions?: int,
     *   encodingFormat?: EncodingFormat|value-of<EncodingFormat>,
     *   user?: string,
     * }|V1CreateEmbeddingParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createEmbedding(
        array|V1CreateEmbeddingParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1CreateEmbeddingParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'llm/v1/embeddings',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all available language models from 40+ providers including OpenAI, Anthropic, Google, and Case.dev's specialized legal models. Returns OpenAI-compatible model metadata with pricing information.
     *
     * This endpoint is compatible with OpenAI's models API format, making it easy to integrate with existing applications.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listModels(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'llm/v1/models',
            options: $requestOptions,
            convert: null,
        );
    }
}
