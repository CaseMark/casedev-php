<?php

declare(strict_types=1);

namespace CaseDev\Services\Mail\V1;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Mail\V1\Inboxes\InboxCreateParams;
use CaseDev\Mail\V1\Inboxes\InboxGetAttachmentParams;
use CaseDev\Mail\V1\Inboxes\InboxGetMessageParams;
use CaseDev\Mail\V1\Inboxes\InboxReplyParams;
use CaseDev\Mail\V1\Inboxes\InboxSetPolicyParams;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Mail\V1\InboxesRawContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class InboxesRawService implements InboxesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an inbox owned by the authenticated organization.
     *
     * @param array{address?: string, displayName?: string}|InboxCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|InboxCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'mail/v1/inboxes',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['mail/v1/inboxes/%1$s', $inboxID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List inboxes owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'mail/v1/inboxes',
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delete an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['mail/v1/inboxes/%1$s', $inboxID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get attachment metadata for a message in an inbox owned by the authenticated organization.
     *
     * @param array{
     *   inboxID: string, messageID: string
     * }|InboxGetAttachmentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getAttachment(
        string $attachmentID,
        array|InboxGetAttachmentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxGetAttachmentParams::parseRequest(
            $params,
            $requestOptions,
        );
        $inboxID = $parsed['inboxID'];
        unset($parsed['inboxID']);
        $messageID = $parsed['messageID'];
        unset($parsed['messageID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'mail/v1/inboxes/%1$s/messages/%2$s/attachments/%3$s',
                $inboxID,
                $messageID,
                $attachmentID,
            ],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a message for an inbox owned by the authenticated organization.
     *
     * @param array{inboxID: string}|InboxGetMessageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getMessage(
        string $messageID,
        array|InboxGetMessageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxGetMessageParams::parseRequest(
            $params,
            $requestOptions,
        );
        $inboxID = $parsed['inboxID'];
        unset($parsed['inboxID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['mail/v1/inboxes/%1$s/messages/%2$s', $inboxID, $messageID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get the sender allowlist and send/reply/read access rules for an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function getPolicy(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['mail/v1/inboxes/%1$s/policy', $inboxID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List messages for an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function listMessages(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['mail/v1/inboxes/%1$s/messages', $inboxID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Reply to a message in an inbox owned by the authenticated organization.
     *
     * @param array{inboxID: string}|InboxReplyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function reply(
        string $messageID,
        array|InboxReplyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxReplyParams::parseRequest(
            $params,
            $requestOptions,
        );
        $inboxID = $parsed['inboxID'];
        unset($parsed['inboxID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['mail/v1/inboxes/%1$s/messages/%2$s/reply', $inboxID, $messageID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Send a message from an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function send(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['mail/v1/inboxes/%1$s/messages/send', $inboxID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Set the sender allowlist and send/reply/read access rules for an inbox owned by the authenticated organization.
     *
     * @param array{
     *   allowedSenderPatterns?: list<string>,
     *   enforceSenderAllowlist?: bool,
     *   readAccessRules?: list<string>,
     *   replyAccessRules?: list<string>,
     *   sendAccessRules?: list<string>,
     * }|InboxSetPolicyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function setPolicy(
        string $inboxID,
        array|InboxSetPolicyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboxSetPolicyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['mail/v1/inboxes/%1$s/policy', $inboxID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
