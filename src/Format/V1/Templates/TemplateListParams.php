<?php

declare(strict_types=1);

namespace CaseDev\Format\V1\Templates;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Retrieve all format templates for the organization. Templates define reusable document formatting patterns with customizable variables for consistent legal document generation.
 *
 * Filter by type to get specific template categories like contracts, pleadings, or correspondence.
 *
 * @see CaseDev\Services\Format\V1\TemplatesService::list()
 *
 * @phpstan-type TemplateListParamsShape = array{type?: string|null}
 */
final class TemplateListParams implements BaseModel
{
    /** @use SdkModel<TemplateListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter templates by type (e.g., contract, pleading, letter).
     */
    #[Optional]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $type = null): self
    {
        $self = new self;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Filter templates by type (e.g., contract, pleading, letter).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
