<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Types;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Core\Conversion\MapOf;
use CaseDev\Matters\V1\Types\TypeUpdateParams\OrchestrationMode;

/**
 * Update a matter type.
 *
 * @see CaseDev\Services\Matters\V1\TypesService::update()
 *
 * @phpstan-type TypeUpdateParamsShape = array{
 *   defaultAgentTypeID?: string|null,
 *   defaultMetadata?: array<string,mixed>|null,
 *   defaultWorkItems?: list<array<string,mixed>>|null,
 *   description?: string|null,
 *   exitCriteria?: list<string>|null,
 *   instructions?: string|null,
 *   intakeRequirements?: list<string>|null,
 *   isActive?: bool|null,
 *   name?: string|null,
 *   orchestrationMode?: null|OrchestrationMode|value-of<OrchestrationMode>,
 *   reviewAgentTypeID?: string|null,
 *   reviewCriteria?: list<string>|null,
 *   skillRefs?: list<string>|null,
 *   slug?: string|null,
 * }
 */
final class TypeUpdateParams implements BaseModel
{
    /** @use SdkModel<TypeUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('default_agent_type_id', nullable: true)]
    public ?string $defaultAgentTypeID;

    /** @var array<string,mixed>|null $defaultMetadata */
    #[Optional('default_metadata', map: 'mixed')]
    public ?array $defaultMetadata;

    /** @var list<array<string,mixed>>|null $defaultWorkItems */
    #[Optional('default_work_items', list: new MapOf('mixed'))]
    public ?array $defaultWorkItems;

    #[Optional(nullable: true)]
    public ?string $description;

    /** @var list<string>|null $exitCriteria */
    #[Optional('exit_criteria', list: 'string')]
    public ?array $exitCriteria;

    #[Optional(nullable: true)]
    public ?string $instructions;

    /** @var list<string>|null $intakeRequirements */
    #[Optional('intake_requirements', list: 'string')]
    public ?array $intakeRequirements;

    #[Optional('is_active')]
    public ?bool $isActive;

    #[Optional]
    public ?string $name;

    /** @var value-of<OrchestrationMode>|null $orchestrationMode */
    #[Optional('orchestration_mode', enum: OrchestrationMode::class)]
    public ?string $orchestrationMode;

    #[Optional('review_agent_type_id', nullable: true)]
    public ?string $reviewAgentTypeID;

    /** @var list<string>|null $reviewCriteria */
    #[Optional('review_criteria', list: 'string')]
    public ?array $reviewCriteria;

    /** @var list<string>|null $skillRefs */
    #[Optional('skill_refs', list: 'string')]
    public ?array $skillRefs;

    #[Optional]
    public ?string $slug;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $defaultMetadata
     * @param list<array<string,mixed>>|null $defaultWorkItems
     * @param list<string>|null $exitCriteria
     * @param list<string>|null $intakeRequirements
     * @param OrchestrationMode|value-of<OrchestrationMode>|null $orchestrationMode
     * @param list<string>|null $reviewCriteria
     * @param list<string>|null $skillRefs
     */
    public static function with(
        ?string $defaultAgentTypeID = null,
        ?array $defaultMetadata = null,
        ?array $defaultWorkItems = null,
        ?string $description = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $intakeRequirements = null,
        ?bool $isActive = null,
        ?string $name = null,
        OrchestrationMode|string|null $orchestrationMode = null,
        ?string $reviewAgentTypeID = null,
        ?array $reviewCriteria = null,
        ?array $skillRefs = null,
        ?string $slug = null,
    ): self {
        $self = new self;

        null !== $defaultAgentTypeID && $self['defaultAgentTypeID'] = $defaultAgentTypeID;
        null !== $defaultMetadata && $self['defaultMetadata'] = $defaultMetadata;
        null !== $defaultWorkItems && $self['defaultWorkItems'] = $defaultWorkItems;
        null !== $description && $self['description'] = $description;
        null !== $exitCriteria && $self['exitCriteria'] = $exitCriteria;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $intakeRequirements && $self['intakeRequirements'] = $intakeRequirements;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $name && $self['name'] = $name;
        null !== $orchestrationMode && $self['orchestrationMode'] = $orchestrationMode;
        null !== $reviewAgentTypeID && $self['reviewAgentTypeID'] = $reviewAgentTypeID;
        null !== $reviewCriteria && $self['reviewCriteria'] = $reviewCriteria;
        null !== $skillRefs && $self['skillRefs'] = $skillRefs;
        null !== $slug && $self['slug'] = $slug;

        return $self;
    }

    public function withDefaultAgentTypeID(?string $defaultAgentTypeID): self
    {
        $self = clone $this;
        $self['defaultAgentTypeID'] = $defaultAgentTypeID;

        return $self;
    }

    /**
     * @param array<string,mixed> $defaultMetadata
     */
    public function withDefaultMetadata(array $defaultMetadata): self
    {
        $self = clone $this;
        $self['defaultMetadata'] = $defaultMetadata;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $defaultWorkItems
     */
    public function withDefaultWorkItems(array $defaultWorkItems): self
    {
        $self = clone $this;
        $self['defaultWorkItems'] = $defaultWorkItems;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<string> $exitCriteria
     */
    public function withExitCriteria(array $exitCriteria): self
    {
        $self = clone $this;
        $self['exitCriteria'] = $exitCriteria;

        return $self;
    }

    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param list<string> $intakeRequirements
     */
    public function withIntakeRequirements(array $intakeRequirements): self
    {
        $self = clone $this;
        $self['intakeRequirements'] = $intakeRequirements;

        return $self;
    }

    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param OrchestrationMode|value-of<OrchestrationMode> $orchestrationMode
     */
    public function withOrchestrationMode(
        OrchestrationMode|string $orchestrationMode
    ): self {
        $self = clone $this;
        $self['orchestrationMode'] = $orchestrationMode;

        return $self;
    }

    public function withReviewAgentTypeID(?string $reviewAgentTypeID): self
    {
        $self = clone $this;
        $self['reviewAgentTypeID'] = $reviewAgentTypeID;

        return $self;
    }

    /**
     * @param list<string> $reviewCriteria
     */
    public function withReviewCriteria(array $reviewCriteria): self
    {
        $self = clone $this;
        $self['reviewCriteria'] = $reviewCriteria;

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
