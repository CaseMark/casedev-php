<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\Files\FileListResponse;
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
    ): string;
}
