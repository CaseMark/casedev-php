<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ChatContract
{
    /**
     * @api
     *
     * @param int|null $idleTimeoutMs Idle timeout before session is eligible for snapshot/termination. Defaults to 15 minutes.
     * @param string|null $model Optional model override for the OpenCode session
     * @param string $title Optional human-readable session title
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?int $idleTimeoutMs = null,
        ?string $model = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): ChatNewResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatDeleteResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ChatCancelResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param mixed $body OpenCode message payload. Passed through 1:1.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        mixed $body,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param int $lastEventID Replay events after this sequence number
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<string>
     *
     * @throws APIException
     */
    public function streamStream(
        string $id,
        ?int $lastEventID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;
}
