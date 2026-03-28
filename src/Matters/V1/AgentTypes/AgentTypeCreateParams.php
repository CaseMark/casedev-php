<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\AgentTypes;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Create a reusable agent role for legal matter orchestration.
 *
 * @see CaseDev\Services\Matters\V1\AgentTypesService::create()
 *
 * @phpstan-type AgentTypeCreateParamsShape = array{
 *   instructions: string,
 *   name: string,
 *   description?: string|null,
 *   disabledTools?: list<string>|null,
 *   enabledTools?: list<string>|null,
 *   isActive?: bool|null,
 *   isDefault?: bool|null,
 *   metadata?: array<string,mixed>|null,
 *   model?: string|null,
 *   skillRefs?: list<string>|null,
 *   slug?: string|null,
 * }
 */
final class AgentTypeCreateParams implements BaseModel
{
    /** @use SdkModel<AgentTypeCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $instructions;

    #[Required]
    public string $name;

    #[Optional]
    public ?string $description;

    /** @var list<string>|null $disabledTools */
    #[Optional('disabled_tools', list: 'string')]
    public ?array $disabledTools;

    /** @var list<string>|null $enabledTools */
    #[Optional('enabled_tools', list: 'string')]
    public ?array $enabledTools;

    #[Optional('is_active')]
    public ?bool $isActive;

    #[Optional('is_default')]
    public ?bool $isDefault;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional]
    public ?string $model;

    /** @var list<string>|null $skillRefs */
    #[Optional('skill_refs', list: 'string')]
    public ?array $skillRefs;

    #[Optional]
    public ?string $slug;

    /**
     * `new AgentTypeCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AgentTypeCreateParams::with(instructions: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AgentTypeCreateParams)->withInstructions(...)->withName(...)
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
     * @param list<string>|null $disabledTools
     * @param list<string>|null $enabledTools
     * @param array<string,mixed>|null $metadata
     * @param list<string>|null $skillRefs
     */
    public static function with(
        string $instructions,
        string $name,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?bool $isActive = null,
        ?bool $isDefault = null,
        ?array $metadata = null,
        ?string $model = null,
        ?array $skillRefs = null,
        ?string $slug = null,
    ): self {
        $self = new self;

        $self['instructions'] = $instructions;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $disabledTools && $self['disabledTools'] = $disabledTools;
        null !== $enabledTools && $self['enabledTools'] = $enabledTools;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $model && $self['model'] = $model;
        null !== $skillRefs && $self['skillRefs'] = $skillRefs;
        null !== $slug && $self['slug'] = $slug;

        return $self;
    }

    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<string> $disabledTools
     */
    public function withDisabledTools(array $disabledTools): self
    {
        $self = clone $this;
        $self['disabledTools'] = $disabledTools;

        return $self;
    }

    /**
     * @param list<string> $enabledTools
     */
    public function withEnabledTools(array $enabledTools): self
    {
        $self = clone $this;
        $self['enabledTools'] = $enabledTools;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * @param list<string> $skillRefs
     */
    public function withSkillRefs(array $skillRefs): self
    {
        $self = clone $this;
        $self['skillRefs'] = $skillRefs;

        return $self;
    }

    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }
}
