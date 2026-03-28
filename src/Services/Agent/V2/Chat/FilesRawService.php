<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\Files\FileDownloadParams;
use CaseDev\Agent\V2\Chat\Files\FileListResponse;
use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\Chat\FilesRawContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Lists files created by the agent in the Daytona runtime workspace. Stopped or archived runtimes are transparently resumed or recovered.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v2/chat/%1$s/files', $id],
            options: $requestOptions,
            convert: FileListResponse::class,
        );
    }

    /**
     * @api
     *
     * Downloads a file from the Daytona runtime workspace by path. Stopped or archived runtimes are transparently resumed or recovered.
     *
     * @param string $filePath File path relative to /workspace (e.g. "report.docx")
     * @param array{id: string}|FileDownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $filePath,
        array|FileDownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FileDownloadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['agent/v2/chat/%1$s/files/%2$s', $id, $filePath],
            headers: ['Accept' => 'application/octet-stream'],
            options: $options,
            convert: 'string',
        );
    }
}
