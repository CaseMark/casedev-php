<?php

declare(strict_types=1);

namespace Casedev\Llm;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Llm\LlmGetConfigResponse\Model;

/**
 * @phpstan-import-type ModelShape from \Casedev\Llm\LlmGetConfigResponse\Model
 *
 * @phpstan-type LlmGetConfigResponseShape = array{models: list<Model|ModelShape>}
 */
final class LlmGetConfigResponse implements BaseModel
{
    /** @use SdkModel<LlmGetConfigResponseShape> */
    use SdkModel;

    /** @var list<Model> $models */
    #[Required(list: Model::class)]
    public array $models;

    /**
     * `new LlmGetConfigResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LlmGetConfigResponse::with(models: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LlmGetConfigResponse)->withModels(...)
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
     * @param list<Model|ModelShape> $models
     */
    public static function with(array $models): self
    {
        $self = new self;

        $self['models'] = $models;

        return $self;
    }

    /**
     * @param list<Model|ModelShape> $models
     */
    public function withModels(array $models): self
    {
        $self = clone $this;
        $self['models'] = $models;

        return $self;
    }
}
