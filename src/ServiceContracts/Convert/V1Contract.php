<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Convert;

use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams\Result;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type ResultShape from \Casedev\Convert\V1\V1WebhookParams\Result
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $id The unique job ID of the completed conversion
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @param string $inputURL HTTPS URL to the FTR file (must be a valid S3 presigned URL)
     * @param string $callbackURL Optional webhook URL to receive conversion completion notification
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function process(
        string $inputURL,
        ?string $callbackURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1ProcessResponse;

    /**
     * @api
     *
     * @param string $jobID Unique identifier for the conversion job
     * @param Status|value-of<Status> $status Status of the conversion job
     * @param string $error Error message for failed jobs
     * @param Result|ResultShape $result Result data for completed jobs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function webhook(
        string $jobID,
        Status|string $status,
        ?string $error = null,
        Result|array|null $result = null,
        RequestOptions|array|null $requestOptions = null,
    ): V1WebhookResponse;
}
