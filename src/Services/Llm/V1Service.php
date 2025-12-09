<?php

declare(strict_types=1);

namespace Casedev\Services\Llm;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Llm\V1\V1CreateEmbeddingParams;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Llm\V1Contract;
use Casedev\Services\Llm\V1\ChatService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public ChatService $chat;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->chat = new ChatService($client);
    }

    /**
     * @api
     *
     * Create vector embeddings from text using OpenAI-compatible models. Perfect for semantic search, document similarity, and building RAG systems for legal documents.
     *
     * @param array{
     *   input: string|list<string>,
     *   model: string,
     *   dimensions?: int,
     *   encodingFormat?: 'float'|'base64'|EncodingFormat,
     *   user?: string,
     * }|V1CreateEmbeddingParams $params
     *
     * @throws APIException
     */
    public function createEmbedding(
        array|V1CreateEmbeddingParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = V1CreateEmbeddingParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'post',
            path: 'llm/v1/embeddings',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all available language models from 40+ providers including OpenAI, Anthropic, Google, and Case.dev's specialized legal models. Returns OpenAI-compatible model metadata with pricing information.
     *
     * This endpoint is compatible with OpenAI's models API format, making it easy to integrate with existing applications.
     *
     * @throws APIException
     */
    public function listModels(?RequestOptions $requestOptions = null): mixed
    {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'get',
            path: 'llm/v1/models',
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }
}
