<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Convert;

use Casedev\Convert\V1\V1ProcessParams;
use Casedev\Convert\V1\V1ProcessResponse;
use Casedev\Convert\V1\V1WebhookParams;
use Casedev\Convert\V1\V1WebhookResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

interface V1Contract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function download(
        string $id,
        ?RequestOptions $requestOptions = null
    ): string;

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

    /**
     * @api
     *
     * @param array<mixed>|V1WebhookParams $params
     *
     * @throws APIException
     */
    public function webhook(
        array|V1WebhookParams $params,
        ?RequestOptions $requestOptions = null
    ): V1WebhookResponse;
}
