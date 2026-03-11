<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatCreateParams;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Agent\V1\Chat\ChatReplyToQuestionParams;
use CaseDev\Agent\V1\Chat\ChatRespondParams;
use CaseDev\Agent\V1\Chat\ChatSendMessageParams;
use CaseDev\Agent\V1\Chat\ChatStreamParams;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface ChatRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ChatCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ChatCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ChatCancelResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $requestID Path param: Pending question request ID
     * @param array<string,mixed>|ChatReplyToQuestionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function replyToQuestion(
        string $requestID,
        array|ChatReplyToQuestionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array<string,mixed>|ChatRespondParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function respond(
        string $id,
        array|ChatRespondParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array<string,mixed>|ChatRespondParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function respondStream(
        string $id,
        array|ChatRespondParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array<string,mixed>|ChatSendMessageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function sendMessage(
        string $id,
        array|ChatSendMessageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array<string,mixed>|ChatStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function stream(
        string $id,
        array|ChatStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Chat session ID
     * @param array<string,mixed>|ChatStreamParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<string>>
     *
     * @throws APIException
     */
    public function streamStream(
        string $id,
        array|ChatStreamParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
