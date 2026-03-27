<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat\Files;

use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Downloads a file from the Daytona runtime workspace by path. Stopped or archived runtimes are transparently resumed or recovered.
 *
 * @see CaseDev\Services\Agent\V2\Chat\FilesService::download()
 *
 * @phpstan-type FileDownloadParamsShape = array{id: string}
 */
final class FileDownloadParams implements BaseModel
{
    /** @use SdkModel<FileDownloadParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new FileDownloadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileDownloadParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileDownloadParams)->withID(...)
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
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
