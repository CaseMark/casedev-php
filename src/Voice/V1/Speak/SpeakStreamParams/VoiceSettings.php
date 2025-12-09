<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak\SpeakStreamParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VoiceSettingsShape = array{
 *   similarityBoost?: float|null,
 *   stability?: float|null,
 *   style?: float|null,
 *   useSpeakerBoost?: bool|null,
 * }
 */
final class VoiceSettings implements BaseModel
{
    /** @use SdkModel<VoiceSettingsShape> */
    use SdkModel;

    /**
     * Similarity boost (0-1).
     */
    #[Optional('similarity_boost')]
    public ?float $similarityBoost;

    /**
     * Voice stability (0-1).
     */
    #[Optional]
    public ?float $stability;

    /**
     * Style exaggeration (0-1).
     */
    #[Optional]
    public ?float $style;

    /**
     * Enable speaker boost.
     */
    #[Optional('use_speaker_boost')]
    public ?bool $useSpeakerBoost;

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
        ?float $similarityBoost = null,
        ?float $stability = null,
        ?float $style = null,
        ?bool $useSpeakerBoost = null,
    ): self {
        $obj = new self;

        null !== $similarityBoost && $obj['similarityBoost'] = $similarityBoost;
        null !== $stability && $obj['stability'] = $stability;
        null !== $style && $obj['style'] = $style;
        null !== $useSpeakerBoost && $obj['useSpeakerBoost'] = $useSpeakerBoost;

        return $obj;
    }

    /**
     * Similarity boost (0-1).
     */
    public function withSimilarityBoost(float $similarityBoost): self
    {
        $obj = clone $this;
        $obj['similarityBoost'] = $similarityBoost;

        return $obj;
    }

    /**
     * Voice stability (0-1).
     */
    public function withStability(float $stability): self
    {
        $obj = clone $this;
        $obj['stability'] = $stability;

        return $obj;
    }

    /**
     * Style exaggeration (0-1).
     */
    public function withStyle(float $style): self
    {
        $obj = clone $this;
        $obj['style'] = $style;

        return $obj;
    }

    /**
     * Enable speaker boost.
     */
    public function withUseSpeakerBoost(bool $useSpeakerBoost): self
    {
        $obj = clone $this;
        $obj['useSpeakerBoost'] = $useSpeakerBoost;

        return $obj;
    }
}
