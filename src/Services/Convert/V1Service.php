<?php

declare(strict_types=1);

namespace Casedev\Services\Convert;

use Casedev\Client;
use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Convert\V1Contract;
use Casedev\Services\Convert\V1\JobsService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public JobsService $jobs;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->jobs = new JobsService($client);
    }

    /**
     * @api
     *
     * Download the converted M4A audio file from a completed FTR conversion job. The file is streamed directly to the client with appropriate headers for audio playback or download.
     *
     * @param string $id The unique job ID of the completed conversion
     *
     * @throws APIException
     */
    public function download(
        string $id,
        ?RequestOptions $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Submit an FTR (ForensicTech Recording) file for conversion to M4A audio format. This endpoint is commonly used to convert court recording files into standard audio formats for transcription or playback. The conversion is processed asynchronously - you'll receive a job ID to track the conversion status.
     *
     * **Supported Input**: FTR files via S3 presigned URLs
     * **Output Format**: M4A audio
     * **Processing**: Asynchronous with webhook callbacks
     *
     * @param string $inputURL HTTPS URL to the FTR file (must be a valid S3 presigned URL)
     * @param string $callbackURL Optional webhook URL to receive conversion completion notification
     *
     * @throws APIException
     */
    public function process(
        string $inputURL,
        ?string $callbackURL = null,
        ?RequestOptions $requestOptions = null,
    ): V1ProcessResponse {
        $params = ['inputURL' => $inputURL, 'callbackURL' => $callbackURL];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->process(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Internal webhook endpoint that receives completion notifications from the Modal FTR converter service. This endpoint handles status updates for file conversion jobs, including success and failure notifications. Requires valid Bearer token authentication.
     *
     * @param string $jobID Unique identifier for the conversion job
     * @param 'completed'|'failed'|Status $status Status of the conversion job
     * @param string $error Error message for failed jobs
     * @param array{
     *   durationSeconds?: float, fileSizeBytes?: int, storedFilename?: string
     * } $result Result data for completed jobs
     *
     * @throws APIException
     */
    public function webhook(
        string $jobID,
        string|Status $status,
        ?string $error = null,
        ?array $result = null,
        ?RequestOptions $requestOptions = null,
    ): V1WebhookResponse {
        $params = [
            'jobID' => $jobID,
            'status' => $status,
            'error' => $error,
            'result' => $result,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->webhook(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
