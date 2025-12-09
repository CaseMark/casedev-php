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
 *   description?: string,
 *   styles?: mixed,
 *   tags?: list<string>,
 *   variables?: list<string>,
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
     * @param list<string> $tags
     * @param list<string> $variables
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
        $obj = new self;

        $obj['content'] = $content;
        $obj['name'] = $name;
        $obj['type'] = $type;

        null !== $description && $obj['description'] = $description;
        null !== $styles && $obj['styles'] = $styles;
        null !== $tags && $obj['tags'] = $tags;
        null !== $variables && $obj['variables'] = $variables;

        return $obj;
    }

    /**
     * Template content with {{variable}} placeholders.
     */
    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * Template name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Template type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Template description.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * CSS styles for the template.
     */
    public function withStyles(mixed $styles): self
    {
        $obj = clone $this;
        $obj['styles'] = $styles;

        return $obj;
    }

    /**
     * Template tags for organization.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }

    /**
     * Template variables (auto-detected if not provided).
     *
     * @param list<string> $variables
     */
    public function withVariables(array $variables): self
    {
        $obj = clone $this;
        $obj['variables'] = $variables;

        return $obj;
    }
}
