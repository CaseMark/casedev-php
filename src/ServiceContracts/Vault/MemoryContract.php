<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Vault;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;
use CaseDev\Vault\Memory\MemoryCreateParams\Type;
use CaseDev\Vault\Memory\MemoryListResponse;
use CaseDev\Vault\Memory\MemoryNewResponse;
use CaseDev\Vault\Memory\MemorySearchResponse;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface MemoryContract
{
    /**
     * @api
     *
     * @param string $id Vault ID
     * @param Type|value-of<Type> $type
     * @param list<string> $tags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $content,
        Type|string $type,
        ?string $source = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): MemoryNewResponse;

    /**
     * @api
     *
     * @param string $entryID Path param: Memory entry ID
     * @param string $id Path param: Vault ID
     * @param string $content Body param
     * @param string|null $source Body param
     * @param list<string> $tags Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $entryID,
        string $id,
        ?string $content = null,
        ?string $source = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): MemoryListResponse;

    /**
     * @api
     *
     * @param string $entryID Memory entry ID
     * @param string $id Vault ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Vault ID
     * @param list<string> $tags
     * @param list<string> $types
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $id,
        string $query,
        int $limit = 10,
        ?array $tags = null,
        ?array $types = null,
        RequestOptions|array|null $requestOptions = null,
    ): MemorySearchResponse;
}
