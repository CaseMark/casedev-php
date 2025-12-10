<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Convert;

use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @param string $id The unique job ID of the completed conversion
     *
     * @throws APIException
     */
    public function download(
        string $id,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
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
    ): V1ProcessResponse;

    /**
     * @api
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
    ): V1WebhookResponse;
}
