<?php

declare(strict_types=1);

namespace CaseDev\Translate\V1\V1DetectResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Core\Conversion\ListOf;
use CaseDev\Translate\V1\V1DetectResponse\Data\Detection;

/**
 * @phpstan-import-type DetectionShape from \CaseDev\Translate\V1\V1DetectResponse\Data\Detection
 *
 * @phpstan-type DataShape = array{
 *   detections?: list<list<Detection|DetectionShape>>|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<list<Detection>>|null $detections */
    #[Optional(list: new ListOf(Detection::class))]
    public ?array $detections;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<list<Detection|DetectionShape>>|null $detections
     */
    public static function with(?array $detections = null): self
    {
        $self = new self;

        null !== $detections && $self['detections'] = $detections;

        return $self;
    }

    /**
     * @param list<list<Detection|DetectionShape>> $detections
     */
    public function withDetections(array $detections): self
    {
        $self = clone $this;
        $self['detections'] = $detections;

        return $self;
    }
}
