<?php

declare(strict_types=1);

namespace Casedev\Services\Projects;

use Casedev\Client;
use Casedev\Core\Contracts\BaseResponse;
use Casedev\Core\Exceptions\APIException;
use Casedev\Projects\V1\V1CreateEnvVarsParams;
use Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar;
use Casedev\Projects\V1\V1CreateParams;
use Casedev\Projects\V1\V1CreateParams\SourceType;
use Casedev\Projects\V1\V1DeleteParams;
use Casedev\Projects\V1\V1DeleteResponse;
use Casedev\Projects\V1\V1ListEnvVarsParams;
use Casedev\Projects\V1\V1ListEnvVarsParams\Environment;
use Casedev\Projects\V1\V1ListResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Projects\V1RawContract;

/**
 * @phpstan-import-type EnvVarShape from \Casedev\Projects\V1\V1CreateEnvVarsParams\EnvVar
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Create a new project for deployments
     *
     * @param array{
     *   name: string,
     *   sourceType: SourceType|value-of<SourceType>,
     *   buildCommand?: string,
     *   defaultMemory?: string,
     *   defaultVcpu?: string,
     *   description?: string,
     *   framework?: string,
     *   githubBranch?: string,
     *   githubRepo?: string,
     *   installCommand?: string,
     *   rootDirectory?: string,
     *   s3SourceBucket?: string,
     *   s3SourcePrefix?: string,
     *   startCommand?: string,
     *   thurgoodSessionID?: string,
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
            path: 'projects/v1',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a project by ID with its deployments and settings
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
            path: ['projects/v1/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all projects for the organization
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1ListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'projects/v1',
            options: $requestOptions,
            convert: V1ListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a project and all its associated deployments, environment variables, and domains.
     *
     * @param string $id Project ID
     * @param array{deleteDeployments?: bool}|V1DeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        array|V1DeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1DeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['projects/v1/%1$s', $id],
            query: $parsed,
            options: $options,
            convert: V1DeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Create or update environment variables for a project
     *
     * @param array{envVars?: list<EnvVar|EnvVarShape>}|V1CreateEnvVarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function createEnvVars(
        string $id,
        array|V1CreateEnvVarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1CreateEnvVarsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['projects/v1/%1$s/env-vars', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List all environment variables for a project, grouped by environment
     *
     * @param array{
     *   environment?: Environment|value-of<Environment>
     * }|V1ListEnvVarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listEnvVars(
        string $id,
        array|V1ListEnvVarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1ListEnvVarsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['projects/v1/%1$s/env-vars', $id],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }
}
