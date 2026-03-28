<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\Parties\PartyCreateParams\Type;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\PartiesContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class PartiesService implements PartiesContract
{
    /**
     * @api
     */
    public PartiesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PartiesRawService($client);
    }

    /**
     * @api
     *
     * Create a reusable legal party for the authenticated organization.
     *
     * @param list<array<string,mixed>> $addresses
     * @param array<string,mixed>|null $customFields
     * @param array<string,mixed> $metadata
     * @param Type|value-of<Type> $type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?array $addresses = null,
        ?array $customFields = null,
        ?string $email = null,
        ?array $metadata = null,
        ?string $notes = null,
        ?string $phone = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'addresses' => $addresses,
                'customFields' => $customFields,
                'email' => $email,
                'metadata' => $metadata,
                'notes' => $notes,
                'phone' => $phone,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a reusable legal party by ID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($partyID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a reusable legal party.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($partyID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List reusable legal parties for the authenticated organization.
     *
     * @param \CaseDev\Matters\V1\Parties\PartyListParams\Type|value-of<\CaseDev\Matters\V1\Parties\PartyListParams\Type> $type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $email = null,
        ?string $query = null,
        \CaseDev\Matters\V1\Parties\PartyListParams\Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['email' => $email, 'query' => $query, 'type' => $type]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
