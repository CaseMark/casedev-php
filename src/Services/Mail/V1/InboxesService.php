<?php

declare(strict_types=1);

namespace CaseDev\Services\Mail\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Mail\V1\InboxesContract;

/**
 * Create, manage, and execute AI agents with tool access, sandbox environments, and async run workflows.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class InboxesService implements InboxesContract
{
    /**
     * @api
     */
    public InboxesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboxesRawService($client);
    }

    /**
     * @api
     *
     * Create an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $address = null,
        ?string $displayName = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['address' => $address, 'displayName' => $displayName]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List inboxes owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($inboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get attachment metadata for a message in an inbox owned by the authenticated organization.
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
    ): mixed {
        $params = Util::removeNulls(
            ['inboxID' => $inboxID, 'messageID' => $messageID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getAttachment($attachmentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a message for an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getMessage(
        string $messageID,
        string $inboxID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['inboxID' => $inboxID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getMessage($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the sender allowlist and send/reply/read access rules for an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPolicy(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getPolicy($inboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List messages for an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listMessages(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listMessages($inboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Reply to a message in an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reply(
        string $messageID,
        string $inboxID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['inboxID' => $inboxID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reply($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a message from an inbox owned by the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $inboxID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->send($inboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Set the sender allowlist and send/reply/read access rules for an inbox owned by the authenticated organization.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'allowedSenderPatterns' => $allowedSenderPatterns,
                'enforceSenderAllowlist' => $enforceSenderAllowlist,
                'readAccessRules' => $readAccessRules,
                'replyAccessRules' => $replyAccessRules,
                'sendAccessRules' => $sendAccessRules,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->setPolicy($inboxID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
