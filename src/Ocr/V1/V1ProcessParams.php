<?php

declare(strict_types=1);

namespace Casedev\Ocr\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Ocr\V1\V1ProcessParams\Engine;
use Casedev\Ocr\V1\V1ProcessParams\Features;

/**
 * Submit a document for OCR processing to extract text, detect tables, forms, and other features. Supports PDFs, images, and scanned documents. Returns a job ID that can be used to track processing status.
 *
 * @see Casedev\Services\Ocr\V1Service::process()
 *
 * @phpstan-type V1ProcessParamsShape = array{
 *   document_url: string,
 *   callback_url?: string,
 *   document_id?: string,
 *   engine?: Engine|value-of<Engine>,
 *   features?: Features|array{
 *     forms?: bool|null, layout?: bool|null, tables?: bool|null, text?: bool|null
 *   },
 *   result_bucket?: string,
 *   result_prefix?: string,
 * }
 */
final class V1ProcessParams implements BaseModel
{
    /** @use SdkModel<V1ProcessParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL or S3 path to the document to process.
     */
    #[Required]
    public string $document_url;

    /**
     * URL to receive completion webhook.
     */
    #[Optional]
    public ?string $callback_url;

    /**
     * Optional custom document identifier.
     */
    #[Optional]
    public ?string $document_id;

    /**
     * OCR engine to use.
     *
     * @var value-of<Engine>|null $engine
     */
    #[Optional(enum: Engine::class)]
    public ?string $engine;

    /**
     * OCR features to extract.
     */
    #[Optional]
    public ?Features $features;

    /**
     * S3 bucket to store results.
     */
    #[Optional]
    public ?string $result_bucket;

    /**
     * S3 key prefix for results.
     */
    #[Optional]
    public ?string $result_prefix;

    /**
     * `new V1ProcessParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProcessParams::with(document_url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1ProcessParams)->withDocumentURL(...)
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
     *
     * @param Engine|value-of<Engine> $engine
     * @param Features|array{
     *   forms?: bool|null, layout?: bool|null, tables?: bool|null, text?: bool|null
     * } $features
     */
    public static function with(
        string $document_url,
        ?string $callback_url = null,
        ?string $document_id = null,
        Engine|string|null $engine = null,
        Features|array|null $features = null,
        ?string $result_bucket = null,
        ?string $result_prefix = null,
    ): self {
        $obj = new self;

        $obj['document_url'] = $document_url;

        null !== $callback_url && $obj['callback_url'] = $callback_url;
        null !== $document_id && $obj['document_id'] = $document_id;
        null !== $engine && $obj['engine'] = $engine;
        null !== $features && $obj['features'] = $features;
        null !== $result_bucket && $obj['result_bucket'] = $result_bucket;
        null !== $result_prefix && $obj['result_prefix'] = $result_prefix;

        return $obj;
    }

    /**
     * URL or S3 path to the document to process.
     */
    public function withDocumentURL(string $documentURL): self
    {
        $obj = clone $this;
        $obj['document_url'] = $documentURL;

        return $obj;
    }

    /**
     * URL to receive completion webhook.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $obj = clone $this;
        $obj['callback_url'] = $callbackURL;

        return $obj;
    }

    /**
     * Optional custom document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj['document_id'] = $documentID;

        return $obj;
    }

    /**
     * OCR engine to use.
     *
     * @param Engine|value-of<Engine> $engine
     */
    public function withEngine(Engine|string $engine): self
    {
        $obj = clone $this;
        $obj['engine'] = $engine;

        return $obj;
    }

    /**
     * OCR features to extract.
     *
     * @param Features|array{
     *   forms?: bool|null, layout?: bool|null, tables?: bool|null, text?: bool|null
     * } $features
     */
    public function withFeatures(Features|array $features): self
    {
        $obj = clone $this;
        $obj['features'] = $features;

        return $obj;
    }

    /**
     * S3 bucket to store results.
     */
    public function withResultBucket(string $resultBucket): self
    {
        $obj = clone $this;
        $obj['result_bucket'] = $resultBucket;

        return $obj;
    }

    /**
     * S3 key prefix for results.
     */
    public function withResultPrefix(string $resultPrefix): self
    {
        $obj = clone $this;
        $obj['result_prefix'] = $resultPrefix;

        return $obj;
    }
}
