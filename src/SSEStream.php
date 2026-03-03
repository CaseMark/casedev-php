<?php

namespace CaseDev;

use CaseDev\Core\Concerns\SdkStream;
use CaseDev\Core\Contracts\BaseStream;
use CaseDev\Core\Conversion;
use CaseDev\Core\Util;

/**
 * @template TItem
 *
 * @implements BaseStream<TItem>
 */
final class SSEStream implements BaseStream
{
    /**
     * @use SdkStream<array{
     *   event?: string|null, data?: string|null, id?: string|null, retry?: int|null
     * },
     * TItem,>
     */
    use SdkStream;

    private function parsedGenerator(): \Generator
    {
        if (!$this->stream->valid()) {
            return;
        }

        foreach ($this->stream as $row) {
            if ($data = $row['data'] ?? null) {
                $decoded = Util::decodeJson($data);

                yield Conversion::coerce($this->convert, value: $decoded);
            }
        }
    }
}
