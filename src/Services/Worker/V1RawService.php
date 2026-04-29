<?php

declare(strict_types=1);

namespace CaseDev\Services\Worker;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Worker\V1RawContract;
use CaseDev\Worker\V1\V1ProxyDeleteParams;
use CaseDev\Worker\V1\V1ProxyGetParams;
use CaseDev\Worker\V1\V1ProxyPatchParams;
use CaseDev\Worker\V1\V1ProxyPostParams;
use CaseDev\Worker\V1\V1ProxyPutParams;

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
     * Creates a Daytona-backed worker runtime. The worker exposes its native runtime API through /worker/v1/:id/* without reshaping payloads or events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'worker/v1',
            options: $requestOptions,
            convert: null
        );
    }

    /**
     * @api
     *
     * Get worker
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['worker/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * End worker
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['worker/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Starts or resumes the worker sandbox and OpenCode server. Native /worker/v1/:id/* proxy routes require this lifecycle primitive to have completed first.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function boot(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['worker/v1/%1$s/boot', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Forwards a DELETE request to the worker runtime without translating response shapes.
     *
     * @param array{id: string}|V1ProxyDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function proxyDelete(
        string $workerPath,
        array|V1ProxyDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProxyDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['worker/v1/%1$s/%2$s', $id, $workerPath],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Forwards a GET request to the worker runtime without translating response or SSE event shapes.
     *
     * @param array{id: string}|V1ProxyGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function proxyGet(
        string $workerPath,
        array|V1ProxyGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProxyGetParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['worker/v1/%1$s/%2$s', $id, $workerPath],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Forwards a PATCH request to the worker runtime without translating request or response shapes.
     *
     * @param array{id: string}|V1ProxyPatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function proxyPatch(
        string $workerPath,
        array|V1ProxyPatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProxyPatchParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['worker/v1/%1$s/%2$s', $id, $workerPath],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Forwards a POST request to the worker runtime without translating request, response, or SSE event shapes.
     *
     * @param array{id: string}|V1ProxyPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function proxyPost(
        string $workerPath,
        array|V1ProxyPostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProxyPostParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['worker/v1/%1$s/%2$s', $id, $workerPath],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Forwards a PUT request to the worker runtime without translating request or response shapes.
     *
     * @param array{id: string}|V1ProxyPutParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function proxyPut(
        string $workerPath,
        array|V1ProxyPutParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ProxyPutParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['worker/v1/%1$s/%2$s', $id, $workerPath],
            options: $options,
            convert: null,
        );
    }
}
