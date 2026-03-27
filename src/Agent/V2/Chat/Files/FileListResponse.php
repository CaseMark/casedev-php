<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat\Files;

use CaseDev\Agent\V2\Chat\Files\FileListResponse\File;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type FileShape from \CaseDev\Agent\V2\Chat\Files\FileListResponse\File
 *
 * @phpstan-type FileListResponseShape = array{
 *   chatID?: string|null, files?: list<File|FileShape>|null
 * }
 */
final class FileListResponse implements BaseModel
{
    /** @use SdkModel<FileListResponseShape> */
    use SdkModel;

    #[Optional('chatId')]
    public ?string $chatID;

    /** @var list<File>|null $files */
    #[Optional(list: File::class)]
    public ?array $files;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<File|FileShape>|null $files
     */
    public static function with(
        ?string $chatID = null,
        ?array $files = null
    ): self {
        $self = new self;

        null !== $chatID && $self['chatID'] = $chatID;
        null !== $files && $self['files'] = $files;

        return $self;
    }

    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * @param list<File|FileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }
}
