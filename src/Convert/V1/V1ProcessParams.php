<?php

declare(strict_types=1);

namespace Casedev\Convert\V1;

use Casedev\Core\Attributes\Api;
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
 *   input_url: string, callback_url?: string
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
    #[Api]
    public string $input_url;

    /**
     * Optional webhook URL to receive conversion completion notification.
     */
    #[Api(optional: true)]
    public ?string $callback_url;

    /**
     * `new V1ProcessParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProcessParams::with(input_url: ...)
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
        string $input_url,
        ?string $callback_url = null
    ): self {
        $obj = new self;

        $obj->input_url = $input_url;

        null !== $callback_url && $obj->callback_url = $callback_url;

        return $obj;
    }

    /**
     * HTTPS URL to the FTR file (must be a valid S3 presigned URL).
     */
    public function withInputURL(string $inputURL): self
    {
        $obj = clone $this;
        $obj->input_url = $inputURL;

        return $obj;
    }

    /**
     * Optional webhook URL to receive conversion completion notification.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $obj = clone $this;
        $obj->callback_url = $callbackURL;

        return $obj;
    }
}
