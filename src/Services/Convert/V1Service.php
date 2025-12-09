<?php

declare(strict_types=1);

namespace Casedev\Services\Convert;

use Casedev\Client;
use Casedev\Convert\V1\V1ProcessParams;
use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Convert\V1Contract;
use Casedev\Services\Convert\V1\JobsService;

final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public JobsService $jobs;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->jobs = new JobsService($client);
    }

    /**
     * @api
     *
     * Download the converted M4A audio file from a completed FTR conversion job. The file is streamed directly to the client with appropriate headers for audio playback or download.
     *
     * @throws APIException
     */
    public function download(
        string $id,
        ?RequestOptions $requestOptions = null
    ): string {
        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'get',
            path: ['convert/v1/download/%1$s', $id],
            headers: ['Accept' => 'audio/mp4'],
            options: $requestOptions,
            convert: 'string',
        );

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
     * @param array{input_url: string, callback_url?: string}|V1ProcessParams $params
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ProcessResponse {
        [$parsed, $options] = V1ProcessParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1ProcessResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'convert/v1/process',
            body: (object) $parsed,
            options: $options,
            convert: V1ProcessResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Internal webhook endpoint that receives completion notifications from the Modal FTR converter service. This endpoint handles status updates for file conversion jobs, including success and failure notifications. Requires valid Bearer token authentication.
     *
     * @param array{
     *   job_id: string,
     *   status: 'completed'|'failed',
     *   error?: string,
     *   result?: array{
     *     duration_seconds?: float, file_size_bytes?: int, stored_filename?: string
     *   },
     * }|V1WebhookParams $params
     *
     * @throws APIException
     */
    public function webhook(
        array|V1WebhookParams $params,
        ?RequestOptions $requestOptions = null
    ): V1WebhookResponse {
        [$parsed, $options] = V1WebhookParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<V1WebhookResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'convert/v1/webhook',
            body: (object) $parsed,
            options: $options,
            convert: V1WebhookResponse::class,
        );

        return $response->parse();
    }
}
