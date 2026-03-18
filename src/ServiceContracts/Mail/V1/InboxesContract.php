<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Mail\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface InboxesContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $address = null,
        ?string $displayName = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getAttachment(
        string $attachmentID,
        string $inboxID,
        string $messageID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getMessage(
        string $messageID,
        string $inboxID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPolicy(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listMessages(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reply(
        string $messageID,
        string $inboxID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param list<string> $allowedSenderPatterns Exact emails, @domain rules, or *
     * @param list<string> $readAccessRules Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *
     * @param list<string> $replyAccessRules Rules like organization, operator, user:<id>, api_key, api_key:<id>, clerk_session, or *
     * @param list<string> $sendAccessRules Rules like organization, user:<id>, api_key, api_key:<id>, clerk_session, or *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function setPolicy(
        string $inboxID,
        ?array $allowedSenderPatterns = null,
        ?bool $enforceSenderAllowlist = null,
        ?array $readAccessRules = null,
        ?array $replyAccessRules = null,
        ?array $sendAccessRules = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
