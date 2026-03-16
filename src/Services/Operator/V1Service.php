<?php

declare(strict_types=1);

namespace CaseDev\Services\Operator;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Operator\V1\V1CreateParams\Size;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Operator\V1Contract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
    }

    /**
     * @api
     *
     * Provision a new operator instance for the organization.
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
    ): mixed {
        $params = Util::removeNulls(
            ['name' => $name, 'model' => $model, 'size' => $size]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Proxy a chat completion request to the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createChatCompletion(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createChatCompletion(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Proxy a response request to the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createResponse(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createResponse(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the status of the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatus(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatus(requestOptions: $requestOptions);

        return $response->parse();
    }
}
