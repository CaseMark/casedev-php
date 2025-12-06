<?php

declare(strict_types=1);

namespace Casedev\Vault\Objects;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;

/**
 * Downloads a file from a vault. Returns the actual file content as a binary stream with appropriate headers for file download. Useful for retrieving contracts, depositions, case files, and other legal documents stored in your vault.
 *
 * @see Casedev\Services\Vault\ObjectsService::download()
 *
 * @phpstan-type ObjectDownloadParamsShape = array{id: string}
 */
final class ObjectDownloadParams implements BaseModel
{
    /** @use SdkModel<ObjectDownloadParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $id;

    /**
     * `new ObjectDownloadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ObjectDownloadParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ObjectDownloadParams)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $id): self
    {
        $obj = new self;

        $obj['id'] = $id;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }
}
