<?php

declare(strict_types=1);

namespace Casedev\Llm\V1\Chat;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Choice;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse\Usage;

/**
 * @phpstan-type ChatNewCompletionResponseShape = array{
 *   id?: string|null,
 *   choices?: list<Choice>|null,
 *   created?: int|null,
 *   model?: string|null,
 *   object?: string|null,
 *   usage?: Usage|null,
 * }
 */
final class ChatNewCompletionResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ChatNewCompletionResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique identifier for the completion.
     */
    #[Api(optional: true)]
    public ?string $id;

    /** @var list<Choice>|null $choices */
    #[Api(list: Choice::class, optional: true)]
    public ?array $choices;

    /**
     * Unix timestamp of completion creation.
     */
    #[Api(optional: true)]
    public ?int $created;

    /**
     * Model used for completion.
     */
    #[Api(optional: true)]
    public ?string $model;

    #[Api(optional: true)]
    public ?string $object;

    #[Api(optional: true)]
    public ?Usage $usage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Choice> $choices
     */
    public static function with(
        ?string $id = null,
        ?array $choices = null,
        ?int $created = null,
        ?string $model = null,
        ?string $object = null,
        ?Usage $usage = null,
    ): self {
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $choices && $obj->choices = $choices;
        null !== $created && $obj->created = $created;
        null !== $model && $obj->model = $model;
        null !== $object && $obj->object = $object;
        null !== $usage && $obj->usage = $usage;

        return $obj;
    }

    /**
     * Unique identifier for the completion.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * @param list<Choice> $choices
     */
    public function withChoices(array $choices): self
    {
        $obj = clone $this;
        $obj->choices = $choices;

        return $obj;
    }

    /**
     * Unix timestamp of completion creation.
     */
    public function withCreated(int $created): self
    {
        $obj = clone $this;
        $obj->created = $created;

        return $obj;
    }

    /**
     * Model used for completion.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj->model = $model;

        return $obj;
    }

    public function withObject(string $object): self
    {
        $obj = clone $this;
        $obj->object = $object;

        return $obj;
    }

    public function withUsage(Usage $usage): self
    {
        $obj = clone $this;
        $obj->usage = $usage;

        return $obj;
    }
}
