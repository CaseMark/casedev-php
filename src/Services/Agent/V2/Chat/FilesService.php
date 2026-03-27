<?php

declare(strict_types=1);

namespace CaseDev\Services\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\Files\FileListResponse;
use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Agent\V2\Chat\FilesContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }

    /**
     * @api
     *
     * Lists files created by the agent in the Daytona runtime workspace. Stopped or archived runtimes are transparently resumed or recovered.
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): FileListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Downloads a file from the Daytona runtime workspace by path. Stopped or archived runtimes are transparently resumed or recovered.
     *
     * @param string $filePath File path relative to /workspace (e.g. "report.docx")
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $filePath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($filePath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
