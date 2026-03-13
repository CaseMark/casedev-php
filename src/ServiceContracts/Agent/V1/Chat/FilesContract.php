<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1\Chat;

use CaseDev\Agent\V1\Chat\Files\FileListResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface FilesContract
{
    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): FileListResponse;

    /**
     * @api
     *
     * @param string $path File path relative to /workspace (e.g. "report.docx")
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $path,
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): string;
}
