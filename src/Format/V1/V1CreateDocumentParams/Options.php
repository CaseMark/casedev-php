<?php

declare(strict_types=1);

namespace Casedev\Format\V1\V1CreateDocumentParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Format\V1\V1CreateDocumentParams\Options\Component;

/**
 * @phpstan-type OptionsShape = array{components?: list<Component>|null}
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Template components with variables.
     *
     * @var list<Component>|null $components
     */
    #[Optional(list: Component::class)]
    public ?array $components;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Component|array{
     *   content?: string|null,
     *   styles?: mixed,
     *   templateID?: string|null,
     *   variables?: mixed,
     * }> $components
     */
    public static function with(?array $components = null): self
    {
        $self = new self;

        null !== $components && $self['components'] = $components;

        return $self;
    }

    /**
     * Template components with variables.
     *
     * @param list<Component|array{
     *   content?: string|null,
     *   styles?: mixed,
     *   templateID?: string|null,
     *   variables?: mixed,
     * }> $components
     */
    public function withComponents(array $components): self
    {
        $self = clone $this;
        $self['components'] = $components;

        return $self;
    }
}
