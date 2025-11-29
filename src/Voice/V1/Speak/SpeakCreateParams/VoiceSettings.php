<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\Speak\SpeakCreateParams;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * Voice customization settings.
 *
 * @phpstan-type VoiceSettingsShape = array{
 *   similarity_boost?: float|null,
 *   stability?: float|null,
 *   style?: float|null,
 *   use_speaker_boost?: bool|null,
 * }
 */
final class VoiceSettings implements BaseModel
{
    /** @use SdkModel<VoiceSettingsShape> */
    use SdkModel;

    /**
     * Similarity boost (0-1).
     */
    #[Api(optional: true)]
    public ?float $similarity_boost;

    /**
     * Voice stability (0-1).
     */
    #[Api(optional: true)]
    public ?float $stability;

    /**
     * Style exaggeration (0-1).
     */
    #[Api(optional: true)]
    public ?float $style;

    /**
     * Enable speaker boost.
     */
    #[Api(optional: true)]
    public ?bool $use_speaker_boost;

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
        ?float $similarity_boost = null,
        ?float $stability = null,
        ?float $style = null,
        ?bool $use_speaker_boost = null,
    ): self {
        $obj = new self;

        null !== $similarity_boost && $obj->similarity_boost = $similarity_boost;
        null !== $stability && $obj->stability = $stability;
        null !== $style && $obj->style = $style;
        null !== $use_speaker_boost && $obj->use_speaker_boost = $use_speaker_boost;

        return $obj;
    }

    /**
     * Similarity boost (0-1).
     */
    public function withSimilarityBoost(float $similarityBoost): self
    {
        $obj = clone $this;
        $obj->similarity_boost = $similarityBoost;

        return $obj;
    }

    /**
     * Voice stability (0-1).
     */
    public function withStability(float $stability): self
    {
        $obj = clone $this;
        $obj->stability = $stability;

        return $obj;
    }

    /**
     * Style exaggeration (0-1).
     */
    public function withStyle(float $style): self
    {
        $obj = clone $this;
        $obj->style = $style;

        return $obj;
    }

    /**
     * Enable speaker boost.
     */
    public function withUseSpeakerBoost(bool $useSpeakerBoost): self
    {
        $obj = clone $this;
        $obj->use_speaker_boost = $useSpeakerBoost;

        return $obj;
    }
}
