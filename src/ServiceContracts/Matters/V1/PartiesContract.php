<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Parties\PartyCreateParams\Type;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface PartiesContract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $partyID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
