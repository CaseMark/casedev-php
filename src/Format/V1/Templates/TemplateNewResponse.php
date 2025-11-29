<?php

declare(strict_types=1);

namespace Casedev\Format\V1\Templates;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkResponse;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type TemplateNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   type?: string|null,
 *   variables?: list<string>|null,
 * }
 */
final class TemplateNewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TemplateNewResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Template ID.
     */
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Creation timestamp.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Template name.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Template type.
     */
    #[Api(optional: true)]
    public ?string $type;

    /**
     * Detected template variables.
     *
     * @var list<string>|null $variables
     */
    #[Api(list: 'string', optional: true)]
    public ?array $variables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $variables
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $name = null,
        ?string $type = null,
        ?array $variables = null,
    ): self {
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $createdAt && $obj->createdAt = $createdAt;
        null !== $name && $obj->name = $name;
        null !== $type && $obj->type = $type;
        null !== $variables && $obj->variables = $variables;

        return $obj;
    }

    /**
     * Template ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Template name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Template type.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Detected template variables.
     *
     * @param list<string> $variables
     */
    public function withVariables(array $variables): self
    {
        $obj = clone $this;
        $obj->variables = $variables;

        return $obj;
    }
}
