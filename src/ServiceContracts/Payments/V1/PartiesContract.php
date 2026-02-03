<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Payments\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Payments\V1\Parties\PartyCreateParams\Role;
use Casedev\Payments\V1\Parties\PartyCreateParams\Type;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface PartiesContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listPaymentMethods(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
