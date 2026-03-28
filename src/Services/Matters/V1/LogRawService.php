<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\Log\LogCreateParams;
use CaseDev\Matters\V1\Log\LogExportParams;
use CaseDev\Matters\V1\Log\LogExportParams\Format;
use CaseDev\Matters\V1\Log\LogExportResponse;
use CaseDev\Matters\V1\Log\LogListParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\LogRawContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogListParams\Scope
 * @phpstan-import-type ScopeShape from \CaseDev\Matters\V1\Log\LogExportParams\Scope as ScopeShape1
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class LogRawService implements LogRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Append a manual operational note or event to a matter log.
     *
     * @param array{
     *   summary: string,
     *   details?: array<string,mixed>,
     *   eventType?: string,
     *   workItemID?: string,
     * }|LogCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|LogCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LogCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/log', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List the operational history for a matter.
     *
     * @param array{
     *   actorID?: string,
     *   actorType?: string,
     *   endTime?: \DateTimeInterface,
     *   eventType?: string,
     *   limit?: int,
     *   offset?: int,
     *   scope?: ScopeShape,
     *   startTime?: \DateTimeInterface,
     *   workItemID?: string,
     * }|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LogListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['matters/v1/%1$s/log', $id],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'actorID' => 'actor_id',
                    'actorType' => 'actor_type',
                    'endTime' => 'end_time',
                    'eventType' => 'event_type',
                    'startTime' => 'start_time',
                    'workItemID' => 'work_item_id',
                ],
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Bulk export matter log entries for audits, visibility, and eval pipelines. Supports json, csv, tsv, and jsonl. Limited to 10,000 entries per request.
     *
     * @param array{
     *   actorID?: string,
     *   actorType?: string,
     *   endTime?: \DateTimeInterface,
     *   eventType?: string,
     *   format?: Format|value-of<Format>,
     *   scope?: ScopeShape1,
     *   startTime?: \DateTimeInterface,
     *   workItemID?: string,
     * }|LogExportParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogExportResponse>
     *
     * @throws APIException
     */
    public function export(
        string $id,
        array|LogExportParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LogExportParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['matters/v1/%1$s/log/export', $id],
            body: (object) $parsed,
            options: $options,
            convert: LogExportResponse::class,
        );
    }
}
