<?php

declare(strict_types=1);

namespace Router\Format\V1\Templates;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-type TemplateNewResponseShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   type?: string|null,
 *   variables?: list<string>|null,
 * }
 */
final class TemplateNewResponse implements BaseModel
{
    /** @use SdkModel<TemplateNewResponseShape> */
    use SdkModel;

    /**
     * Template ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Template name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Template type.
     */
    #[Optional]
    public ?string $type;

    /**
     * Detected template variables.
     *
     * @var list<string>|null $variables
     */
    #[Optional(list: 'string')]
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
     * @param list<string>|null $variables
     */
    public static function with(
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $name = null,
        ?string $type = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $name && $self['name'] = $name;
        null !== $type && $self['type'] = $type;
        null !== $variables && $self['variables'] = $variables;

        return $self;
    }

    /**
     * Template ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Template name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Template type.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Detected template variables.
     *
     * @param list<string> $variables
     */
    public function withVariables(array $variables): self
    {
        $self = clone $this;
        $self['variables'] = $variables;

        return $self;
    }
}
