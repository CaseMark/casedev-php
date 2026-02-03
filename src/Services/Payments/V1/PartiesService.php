<?php

declare(strict_types=1);

namespace Casedev\Services\Payments\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Core\Util;
use Casedev\Payments\V1\Parties\PartyCreateParams\Role;
use Casedev\Payments\V1\Parties\PartyCreateParams\Type;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Payments\V1\PartiesContract;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
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
     * Create a new payment party (client, vendor, counsel, etc.)
     *
     * @param Type|value-of<Type> $type
     * @param Role|value-of<Role> $role
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Type|string $type,
        ?string $addressLine1 = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        mixed $metadata = null,
        ?string $phone = null,
        ?string $postalCode = null,
        Role|string|null $role = null,
        ?string $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'type' => $type,
                'addressLine1' => $addressLine1,
                'city' => $city,
                'country' => $country,
                'email' => $email,
                'metadata' => $metadata,
                'phone' => $phone,
                'postalCode' => $postalCode,
                'role' => $role,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get party details by ID
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
     * Update party details
     *
     * @param \Casedev\Payments\V1\Parties\PartyUpdateParams\Role|value-of<\Casedev\Payments\V1\Parties\PartyUpdateParams\Role> $role
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $addressLine1 = null,
        ?string $addressLine2 = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        ?bool $isActive = null,
        mixed $metadata = null,
        ?string $name = null,
        ?string $notes = null,
        ?string $phone = null,
        ?string $postalCode = null,
        \Casedev\Payments\V1\Parties\PartyUpdateParams\Role|string|null $role = null,
        ?string $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'addressLine1' => $addressLine1,
                'addressLine2' => $addressLine2,
                'city' => $city,
                'country' => $country,
                'email' => $email,
                'isActive' => $isActive,
                'metadata' => $metadata,
                'name' => $name,
                'notes' => $notes,
                'phone' => $phone,
                'postalCode' => $postalCode,
                'role' => $role,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List payment parties with optional filters
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 50,
        int $offset = 0,
        ?string $role = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['limit' => $limit, 'offset' => $offset, 'role' => $role, 'type' => $type]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List saved payment methods for a party (from Stripe)
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listPaymentMethods(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listPaymentMethods($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
