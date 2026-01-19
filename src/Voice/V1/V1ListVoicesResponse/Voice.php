<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\V1ListVoicesResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VoiceShape = array{
 *   availableForTiers?: list<string>|null,
 *   category?: string|null,
 *   description?: string|null,
 *   labels?: mixed,
 *   name?: string|null,
 *   previewURL?: string|null,
 *   voiceID?: string|null,
 * }
 */
final class Voice implements BaseModel
{
    /** @use SdkModel<VoiceShape> */
    use SdkModel;

    /**
     * Available subscription tiers.
     *
     * @var list<string>|null $availableForTiers
     */
    #[Optional('available_for_tiers', list: 'string')]
    public ?array $availableForTiers;

    /**
     * Voice category.
     */
    #[Optional]
    public ?string $category;

    /**
     * Voice description.
     */
    #[Optional]
    public ?string $description;

    /**
     * Voice characteristics and metadata.
     */
    #[Optional]
    public mixed $labels;

    /**
     * Voice name.
     */
    #[Optional]
    public ?string $name;

    /**
     * URL to preview audio sample.
     */
    #[Optional('preview_url')]
    public ?string $previewURL;

    /**
     * Unique voice identifier.
     */
    #[Optional('voice_id')]
    public ?string $voiceID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $availableForTiers
     */
    public static function with(
        ?array $availableForTiers = null,
        ?string $category = null,
        ?string $description = null,
        mixed $labels = null,
        ?string $name = null,
        ?string $previewURL = null,
        ?string $voiceID = null,
    ): self {
        $self = new self;

        null !== $availableForTiers && $self['availableForTiers'] = $availableForTiers;
        null !== $category && $self['category'] = $category;
        null !== $description && $self['description'] = $description;
        null !== $labels && $self['labels'] = $labels;
        null !== $name && $self['name'] = $name;
        null !== $previewURL && $self['previewURL'] = $previewURL;
        null !== $voiceID && $self['voiceID'] = $voiceID;

        return $self;
    }

    /**
     * Available subscription tiers.
     *
     * @param list<string> $availableForTiers
     */
    public function withAvailableForTiers(array $availableForTiers): self
    {
        $self = clone $this;
        $self['availableForTiers'] = $availableForTiers;

        return $self;
    }

    /**
     * Voice category.
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Voice description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Voice characteristics and metadata.
     */
    public function withLabels(mixed $labels): self
    {
        $self = clone $this;
        $self['labels'] = $labels;

        return $self;
    }

    /**
     * Voice name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * URL to preview audio sample.
     */
    public function withPreviewURL(string $previewURL): self
    {
        $self = clone $this;
        $self['previewURL'] = $previewURL;

        return $self;
    }

    /**
     * Unique voice identifier.
     */
    public function withVoiceID(string $voiceID): self
    {
        $self = clone $this;
        $self['voiceID'] = $voiceID;

        return $self;
    }
}
