<?php

declare(strict_types=1);

namespace Casedev\Format\V1\V1CreateDocumentParams\Options;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ComponentShape = array{
 *   content?: string|null,
 *   styles?: mixed,
 *   templateId?: string|null,
 *   variables?: mixed,
 * }
 */
final class Component implements BaseModel
{
    /** @use SdkModel<ComponentShape> */
    use SdkModel;

    /**
     * Inline template content.
     */
    #[Optional]
    public ?string $content;

    /**
     * Custom styling options.
     */
    #[Optional]
    public mixed $styles;

    /**
     * ID of saved template component.
     */
    #[Optional]
    public ?string $templateId;

    /**
     * Variables for template interpolation.
     */
    #[Optional]
    public mixed $variables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $content = null,
        mixed $styles = null,
        ?string $templateId = null,
        mixed $variables = null,
    ): self {
        $obj = new self;

        null !== $content && $obj['content'] = $content;
        null !== $styles && $obj['styles'] = $styles;
        null !== $templateId && $obj['templateId'] = $templateId;
        null !== $variables && $obj['variables'] = $variables;

        return $obj;
    }

    /**
     * Inline template content.
     */
    public function withContent(string $content): self
    {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * Custom styling options.
     */
    public function withStyles(mixed $styles): self
    {
        $obj = clone $this;
        $obj['styles'] = $styles;

        return $obj;
    }

    /**
     * ID of saved template component.
     */
    public function withTemplateID(string $templateID): self
    {
        $obj = clone $this;
        $obj['templateId'] = $templateID;

        return $obj;
    }

    /**
     * Variables for template interpolation.
     */
    public function withVariables(mixed $variables): self
    {
        $obj = clone $this;
        $obj['variables'] = $variables;

        return $obj;
    }
}
