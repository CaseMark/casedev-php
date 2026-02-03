<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface TransfersContract
{
    /**
     * @api
     *
     * @param int $amount Amount in cents
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $fromAccountID,
        string $toAccountID,
        ?string $memo = null,
        mixed $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $fromAccountID = null,
        int $limit = 50,
        int $offset = 0,
        ?string $status = null,
        ?string $toAccountID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
