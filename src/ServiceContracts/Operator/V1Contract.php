<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Operator;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Operator\V1\V1CreateParams\Size;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
     *
     * @param string $name Operator name
     * @param string $model Model to use
     * @param Size|value-of<Size> $size Instance size
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $model = null,
        Size|string|null $size = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createChatCompletion(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createResponse(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
