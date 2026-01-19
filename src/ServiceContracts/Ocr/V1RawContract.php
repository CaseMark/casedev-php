<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Ocr;

use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Ocr\V1\V1DownloadParams;
use Casedev\Ocr\V1\V1DownloadParams\Type;
use Casedev\Ocr\V1\V1GetResponse;
use Casedev\Ocr\V1\V1ProcessParams;
use Casedev\Ocr\V1\V1ProcessResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface V1RawContract
{
    /**
     * @api
     *
     * @param string $id The OCR job ID returned from the create OCR endpoint
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1GetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param Type|string $type Format to download: `text` (plain text), `json` (structured data with coordinates), `pdf` (searchable PDF with text layer), `original` (original uploaded document)
     * @param array<string,mixed>|V1DownloadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        array|V1DownloadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|V1ProcessParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ProcessResponse>
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
