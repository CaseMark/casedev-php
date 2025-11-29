<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Ocr;

use Casedev\Core\Exceptions\APIException;
use Casedev\Ocr\V1\V1DownloadParams;
use Casedev\Ocr\V1\V1DownloadParams\Type;
use Casedev\Ocr\V1\V1ProcessParams;
use Casedev\Ocr\V1\V1ProcessResponse;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param Type|value-of<Type> $type
     * @param array<mixed>|V1DownloadParams $params
     *
     * @throws APIException
     */
    public function download(
        Type|string $type,
        array|V1DownloadParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|V1ProcessParams $params
     *
     * @throws APIException
     */
    public function process(
        array|V1ProcessParams $params,
        ?RequestOptions $requestOptions = null
    ): V1ProcessResponse;
}
