<?php

declare(strict_types=1);

namespace Router\Format\V1\Templates;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Format\V1\Templates\TemplateListResponse\Template;

/**
 * @phpstan-import-type TemplateShape from \Router\Format\V1\Templates\TemplateListResponse\Template
 *
 * @phpstan-type TemplateListResponseShape = array{
 *   templates?: list<Template|TemplateShape>|null
 * }
 */
final class TemplateListResponse implements BaseModel
{
    /** @use SdkModel<TemplateListResponseShape> */
    use SdkModel;

    /** @var list<Template>|null $templates */
    #[Optional(list: Template::class)]
    public ?array $templates;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Template|TemplateShape>|null $templates
     */
    public static function with(?array $templates = null): self
    {
        $self = new self;

        null !== $templates && $self['templates'] = $templates;

        return $self;
    }

    /**
     * @param list<Template|TemplateShape> $templates
     */
    public function withTemplates(array $templates): self
    {
        $self = clone $this;
        $self['templates'] = $templates;

        return $self;
    }
}
