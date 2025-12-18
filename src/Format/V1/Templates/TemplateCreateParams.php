<?php

declare(strict_types=1);

namespace Casedev\Format\V1\Templates;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Format\V1\Templates\TemplateCreateParams\Type;

/**
 * Create a new format template for document formatting. Templates support variables using `{{variable}}` syntax and can be used for captions, signatures, letterheads, certificates, footers, or custom formatting needs.
 *
 * @see Casedev\Services\Format\V1\TemplatesService::create()
 *
 * @phpstan-type TemplateCreateParamsShape = array{
 *   content: string,
 *   name: string,
 *   type: Type|value-of<Type>,
 *   description?: string|null,
 *   styles?: mixed,
 *   tags?: list<string>|null,
 *   variables?: list<string>|null,
 * }
 */
final class TemplateCreateParams implements BaseModel
{
    /** @use SdkModel<TemplateCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Template content with {{variable}} placeholders.
     */
    #[Required]
    public string $content;

    /**
     * Template name.
     */
    #[Required]
    public string $name;

    /**
     * Template type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Template description.
     */
    #[Optional]
    public ?string $description;

    /**
     * CSS styles for the template.
     */
    #[Optional]
    public mixed $styles;

    /**
     * Template tags for organization.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Template variables (auto-detected if not provided).
     *
     * @var list<string>|null $variables
     */
    #[Optional(list: 'string')]
    public ?array $variables;

    /**
     * `new TemplateCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateCreateParams::with(content: ..., name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateCreateParams)->withContent(...)->withName(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param list<string>|null $tags
     * @param list<string>|null $variables
     */
    public static function with(
        string $content,
        string $name,
        Type|string $type,
        ?string $description = null,
        mixed $styles = null,
        ?array $tags = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['name'] = $name;
        $self['type'] = $type;

        null !== $description && $self['description'] = $description;
        null !== $styles && $self['styles'] = $styles;
        null !== $tags && $self['tags'] = $tags;
        null !== $variables && $self['variables'] = $variables;

        return $self;
    }

    /**
     * Template content with {{variable}} placeholders.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Template description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * CSS styles for the template.
     */
    public function withStyles(mixed $styles): self
    {
        $self = clone $this;
        $self['styles'] = $styles;

        return $self;
    }

    /**
     * Template tags for organization.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Template variables (auto-detected if not provided).
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
