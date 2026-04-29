<?php

declare(strict_types=1);

namespace CaseDev\Services\Worker;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Worker\V1Contract;

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
     * Creates a Daytona-backed worker runtime. The worker exposes its native runtime API through /worker/v1/:id/* without reshaping payloads or events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get worker
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * End worker
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forwards a DELETE request to the worker runtime without translating response shapes.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function proxyDelete(
        string $workerPath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->proxyDelete($workerPath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forwards a GET request to the worker runtime without translating response or SSE event shapes.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function proxyGet(
        string $workerPath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->proxyGet($workerPath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forwards a PATCH request to the worker runtime without translating request or response shapes.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function proxyPatch(
        string $workerPath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->proxyPatch($workerPath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forwards a POST request to the worker runtime without translating request, response, or SSE event shapes.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function proxyPost(
        string $workerPath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->proxyPost($workerPath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forwards a PUT request to the worker runtime without translating request or response shapes.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function proxyPut(
        string $workerPath,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->proxyPut($workerPath, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
