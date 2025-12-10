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
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $styles && $self['styles'] = $styles;
        null !== $templateID && $self['templateID'] = $templateID;
        null !== $variables && $self['variables'] = $variables;

        return $self;
    }

    /**
     * Inline template content.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Custom styling options.
     */
    public function withStyles(mixed $styles): self
    {
        $self = clone $this;
        $self['styles'] = $styles;

        return $self;
    }

    /**
     * ID of saved template component.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * Variables for template interpolation.
     */
    public function withVariables(mixed $variables): self
    {
        $self = clone $this;
        $self['variables'] = $variables;

        return $self;
    }
}
