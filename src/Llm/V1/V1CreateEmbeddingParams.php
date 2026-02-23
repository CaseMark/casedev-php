<?php

declare(strict_types=1);

namespace Router\Llm\V1;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;
use Router\Llm\V1\V1CreateEmbeddingParams\EncodingFormat;
use Router\Llm\V1\V1CreateEmbeddingParams\Input;

/**
 * Create vector embeddings from text using OpenAI-compatible models. Perfect for semantic search, document similarity, and building RAG systems for legal documents.
 *
 * @see Router\Services\Llm\V1Service::createEmbedding()
 *
 * @phpstan-import-type InputVariants from \Router\Llm\V1\V1CreateEmbeddingParams\Input
 * @phpstan-import-type InputShape from \Router\Llm\V1\V1CreateEmbeddingParams\Input
 *
 * @phpstan-type V1CreateEmbeddingParamsShape = array{
 *   input: InputShape,
 *   model: string,
 *   dimensions?: int|null,
 *   encodingFormat?: null|EncodingFormat|value-of<EncodingFormat>,
 *   user?: string|null,
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
     * @var InputVariants $input
     */
    #[Required(union: Input::class)]
    public string|array $input;

    /**
     * Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small).
     */
    #[Required]
    public string $model;

    /**
     * Number of dimensions for the embeddings (model-specific).
     */
    #[Optional]
    public ?int $dimensions;

    /**
     * Format for returned embeddings.
     *
     * @var value-of<EncodingFormat>|null $encodingFormat
     */
    #[Optional('encoding_format', enum: EncodingFormat::class)]
    public ?string $encodingFormat;

    /**
     * Unique identifier for the end-user.
     */
    #[Optional]
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
     * @param InputShape $input
     * @param EncodingFormat|value-of<EncodingFormat>|null $encodingFormat
     */
    public static function with(
        string|array $input,
        string $model,
        ?int $dimensions = null,
        EncodingFormat|string|null $encodingFormat = null,
        ?string $user = null,
    ): self {
        $self = new self;

        $self['input'] = $input;
        $self['model'] = $model;

        null !== $dimensions && $self['dimensions'] = $dimensions;
        null !== $encodingFormat && $self['encodingFormat'] = $encodingFormat;
        null !== $user && $self['user'] = $user;

        return $self;
    }

    /**
     * Text or array of texts to create embeddings for.
     *
     * @param InputShape $input
     */
    public function withInput(string|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Embedding model to use (e.g., text-embedding-ada-002, text-embedding-3-small).
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Number of dimensions for the embeddings (model-specific).
     */
    public function withDimensions(int $dimensions): self
    {
        $self = clone $this;
        $self['dimensions'] = $dimensions;

        return $self;
    }

    /**
     * Format for returned embeddings.
     *
     * @param EncodingFormat|value-of<EncodingFormat> $encodingFormat
     */
    public function withEncodingFormat(
        EncodingFormat|string $encodingFormat
    ): self {
        $self = clone $this;
        $self['encodingFormat'] = $encodingFormat;

        return $self;
    }

    /**
     * Unique identifier for the end-user.
     */
    public function withUser(string $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }
}
