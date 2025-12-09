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
 *   templateID?: string|null,
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
    #[Optional('templateId')]
    public ?string $templateID;

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
        ?string $templateID = null,
        mixed $variables = null,
    ): self {
        $obj = new self;

        null !== $content && $obj['content'] = $content;
        null !== $styles && $obj['styles'] = $styles;
        null !== $templateID && $obj['templateID'] = $templateID;
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
        $obj['templateID'] = $templateID;

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
