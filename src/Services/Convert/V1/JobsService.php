<?php

declare(strict_types=1);

namespace Casedev\Services\Convert\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Convert\V1\JobsContract;

final class JobsService implements JobsContract
{
    /**
     * @api
     */
    public JobsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JobsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve the status of a file conversion job. Returns detailed information about the conversion progress, completion status, and any errors that occurred during processing.
     *
     * @param string $id The unique identifier of the conversion job
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a converted file from Modal storage by its job ID. This permanently removes the file and its associated metadata from the system.
     *
     * @param string $id The job ID of the converted file to delete
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
