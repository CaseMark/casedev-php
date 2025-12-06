<?php

declare(strict_types=1);

namespace Casedev\Llm\V1;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Casedev\Llm\V1\V1CreateEmbeddingParams\Input;

/**
 * Create vector embeddings from text using OpenAI-compatible models. Perfect for semantic search, document similarity, and building RAG systems for legal documents.
 *
 * @see Casedev\Services\Llm\V1Service::createEmbedding()
 *
 * @phpstan-type V1CreateEmbeddingParamsShape = array{
 *   input: string|list<string>,
 *   model: string,
 *   dimensions?: int,
 *   encoding_format?: EncodingFormat|value-of<EncodingFormat>,
 *   user?: string,
 * }
 */
final class V1CreateEmbeddingParams implements BaseModel
{
    /** @use SdkModel<V1CreateEmbeddingParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text or array of texts to create embeddings for.
     *
     * @var string|list<string> $input
     */
    #[Api(union: Input::class)]
    public string|array $input;

    /**
     * Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small).
     */
    #[Api]
    public string $model;

    /**
     * Number of dimensions for the embeddings (model-specific).
     */
    #[Api(optional: true)]
    public ?int $dimensions;

    /**
     * Format for returned embeddings.
     *
     * @var value-of<EncodingFormat>|null $encoding_format
     */
    #[Api(enum: EncodingFormat::class, optional: true)]
    public ?string $encoding_format;

    /**
     * Unique identifier for the end-user.
     */
    #[Api(optional: true)]
    public ?string $user;

    /**
     * `new V1CreateEmbeddingParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateEmbeddingParams::with(input: ..., model: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateEmbeddingParams)->withInput(...)->withModel(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param string|list<string> $input
     * @param EncodingFormat|value-of<EncodingFormat> $encoding_format
     */
    public static function with(
        string|array $input,
        string $model,
        ?int $dimensions = null,
        EncodingFormat|string|null $encoding_format = null,
        ?string $user = null,
    ): self {
        $obj = new self;

        $obj['input'] = $input;
        $obj['model'] = $model;

        null !== $dimensions && $obj['dimensions'] = $dimensions;
        null !== $encoding_format && $obj['encoding_format'] = $encoding_format;
        null !== $user && $obj['user'] = $user;

        return $obj;
    }

    /**
     * Text or array of texts to create embeddings for.
     *
     * @param string|list<string> $input
     */
    public function withInput(string|array $input): self
    {
        $obj = clone $this;
        $obj['input'] = $input;

        return $obj;
    }

    /**
     * Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small).
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Number of dimensions for the embeddings (model-specific).
     */
    public function withDimensions(int $dimensions): self
    {
        $obj = clone $this;
        $obj['dimensions'] = $dimensions;

        return $obj;
    }

    /**
     * Format for returned embeddings.
     *
     * @param EncodingFormat|value-of<EncodingFormat> $encodingFormat
     */
    public function withEncodingFormat(
        EncodingFormat|string $encodingFormat
    ): self {
        $obj = clone $this;
        $obj['encoding_format'] = $encodingFormat;

        return $obj;
    }

    /**
     * Unique identifier for the end-user.
     */
    public function withUser(string $user): self
    {
        $obj = clone $this;
        $obj['user'] = $user;

        return $obj;
    }
}
