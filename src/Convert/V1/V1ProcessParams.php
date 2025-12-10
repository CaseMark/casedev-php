<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Submit an FTR (ForensicTech Recording) file for conversion to M4A audio format. This endpoint is commonly used to convert court recording files into standard audio formats for transcription or playback. The conversion is processed asynchronously - you'll receive a job ID to track the conversion status.
 *
 * **Supported Input**: FTR files via S3 presigned URLs
 * **Output Format**: M4A audio
 * **Processing**: Asynchronous with webhook callbacks
 *
 * @see Casedev\Services\Convert\V1Service::process()
 *
 * @phpstan-type V1ProcessParamsShape = array{
 *   inputURL: string, callbackURL?: string
 * }
 */
final class V1ProcessParams implements BaseModel
{
    /** @use SdkModel<V1ProcessParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * HTTPS URL to the FTR file (must be a valid S3 presigned URL).
     */
    #[Required('input_url')]
    public string $inputURL;

    /**
     * Optional webhook URL to receive conversion completion notification.
     */
    #[Optional('callback_url')]
    public ?string $callbackURL;

    /**
     * `new V1ProcessParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProcessParams::with(inputURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ProcessParams)->withInputURL(...)
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
     */
    public static function with(
        string $inputURL,
        ?string $callbackURL = null
    ): self {
        $self = new self;

        $self['inputURL'] = $inputURL;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * HTTPS URL to the FTR file (must be a valid S3 presigned URL).
     */
    public function withInputURL(string $inputURL): self
    {
        $self = clone $this;
        $self['inputURL'] = $inputURL;

        return $self;
    }

    /**
     * Optional webhook URL to receive conversion completion notification.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }
}
