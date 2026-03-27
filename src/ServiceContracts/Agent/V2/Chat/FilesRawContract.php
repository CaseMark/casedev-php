<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V2\Chat;

use CaseDev\Agent\V2\Chat\Files\FileDownloadParams;
use CaseDev\Agent\V2\Chat\Files\FileListResponse;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface FilesRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $filePath File path relative to /workspace (e.g. "report.docx")
     * @param array<string,mixed>|FileDownloadParams $params
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
    ): BaseResponse;
}
