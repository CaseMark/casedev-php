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
     *   templateId?: string|null,
     *   variables?: mixed,
     * }> $components
     */
    public static function with(?array $components = null): self
    {
        $obj = new self;

        null !== $components && $obj['components'] = $components;

        return $obj;
    }

    /**
     * Template components with variables.
     *
     * @param list<Component|array{
     *   content?: string|null,
     *   styles?: mixed,
     *   templateId?: string|null,
     *   variables?: mixed,
     * }> $components
     */
    public function withComponents(array $components): self
    {
        $obj = clone $this;
        $obj['components'] = $components;

        return $obj;
    }
}
