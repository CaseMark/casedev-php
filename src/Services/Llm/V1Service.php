<?php

declare(strict_types=1);

namespace Casedev\Services\Llm;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Llm\V1Contract;
use Casedev\Services\Llm\V1\ChatService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public ChatService $chat;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->chat = new ChatService($client);
    }

    /**
     * @api
     *
     * Create vector embeddings from text using OpenAI-compatible models. Perfect for semantic search, document similarity, and building RAG systems for legal documents.
     *
     * @param string|list<string> $input Text or array of texts to create embeddings for
     * @param string $model Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small)
     * @param int $dimensions Number of dimensions for the embeddings (model-specific)
     * @param 'float'|'base64'|EncodingFormat $encodingFormat Format for returned embeddings
     * @param string $user Unique identifier for the end-user
     *
     * @throws APIException
     */
    public function createEmbedding(
        string|array $input,
        string $model,
        ?int $dimensions = null,
        string|EncodingFormat $encodingFormat = 'float',
        ?string $user = null,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'model' => $model,
                'dimensions' => $dimensions,
                'encodingFormat' => $encodingFormat,
                'user' => $user,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createEmbedding(params: $params, requestOptions: $requestOptions);

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listModels(requestOptions: $requestOptions);

        return $response->parse();
    }
}
