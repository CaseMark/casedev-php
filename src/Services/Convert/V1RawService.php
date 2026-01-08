<?php

declare(strict_types=1);

namespace Casedev\Services\Convert;

use Casedev\Client;
use Casedev\Convert\V1\V1ProcessParams;
use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams;
use Casedev\Convert\V1\V1WebhookParams\Result;
use Casedev\Convert\V1\V1WebhookParams\Status;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Convert\V1RawContract;

/**
 * @phpstan-import-type ResultShape from \Casedev\Convert\V1\V1WebhookParams\Result
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Download the converted M4A audio file from a completed FTR conversion job. The file is streamed directly to the client with appropriate headers for audio playback or download.
     *
     * @param string $id The unique job ID of the completed conversion
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['convert/v1/download/%1$s', $id],
            headers: ['Accept' => 'audio/mp4'],
            options: $requestOptions,
            convert: 'string',
        );
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
     * @param array{inputURL: string, callbackURL?: string}|V1ProcessParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProcessParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'convert/v1/process',
            body: (object) $parsed,
            options: $options,
            convert: V1ProcessResponse::class,
        );
    }

    /**
     * @api
     *
     * Internal webhook endpoint that receives completion notifications from the Modal FTR converter service. This endpoint handles status updates for file conversion jobs, including success and failure notifications. Requires valid Bearer token authentication.
     *
     * @param array{
     *   jobID: string,
     *   status: Status|value-of<Status>,
     *   error?: string,
     *   result?: Result|ResultShape,
     * }|V1WebhookParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1WebhookResponse>
     *
     * @throws APIException
     */
    public function webhook(
        array|V1WebhookParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1WebhookParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'convert/v1/webhook',
            body: (object) $parsed,
            options: $options,
            convert: V1WebhookResponse::class,
        );
    }
}
