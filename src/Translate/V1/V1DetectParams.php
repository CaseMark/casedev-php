<?php

declare(strict_types=1);

namespace Casedev\Translate\V1;

use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Translate\V1\V1DetectParams\Q;

/**
 * Detect the language of text. Returns the most likely language code and confidence score. Supports batch detection for multiple texts.
 *
 * @see Casedev\Services\Translate\V1Service::detect()
 *
 * @phpstan-import-type QVariants from \Casedev\Translate\V1\V1DetectParams\Q
 * @phpstan-import-type QShape from \Casedev\Translate\V1\V1DetectParams\Q
 *
 * @phpstan-type V1DetectParamsShape = array{q: QShape}
 */
final class V1DetectParams implements BaseModel
{
    /** @use SdkModel<V1DetectParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Text to detect language for. Can be a single string or an array for batch detection.
     *
     * @var QVariants $q
     */
    #[Required(union: Q::class)]
    public string|array $q;

    /**
     * `new V1DetectParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DetectParams::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DetectParams)->withQ(...)
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
     * @param QShape $q
     */
    public static function with(string|array $q): self
    {
        $self = new self;

        $self['q'] = $q;

        return $self;
    }

    /**
     * Text to detect language for. Can be a single string or an array for batch detection.
     *
     * @param QShape $q
     */
    public function withQ(string|array $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }
}
