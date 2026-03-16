<?php

declare(strict_types=1);

namespace CaseDev\Services\Operator;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Operator\V1\V1CreateParams;
use CaseDev\Operator\V1\V1CreateParams\Size;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Operator\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Provision a new operator instance for the organization.
     *
     * @param array{
     *   name: string, model?: string, size?: Size|value-of<Size>
     * }|V1CreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|V1CreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1CreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'operator/v1/create',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Proxy a chat completion request to the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createChatCompletion(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'operator/v1/chat/completions',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Proxy a response request to the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createResponse(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'operator/v1/responses',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get the status of the organization's operator instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getStatus(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'operator/v1/status',
            options: $requestOptions,
            convert: null,
        );
    }
}
