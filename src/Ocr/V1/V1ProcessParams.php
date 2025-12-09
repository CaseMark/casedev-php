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
 *   documentURL: string,
 *   callbackURL?: string,
 *   documentID?: string,
 *   engine?: Engine|value-of<Engine>,
 *   features?: Features|array{
 *     forms?: bool|null, layout?: bool|null, tables?: bool|null, text?: bool|null
 *   },
 *   resultBucket?: string,
 *   resultPrefix?: string,
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
    #[Required('document_url')]
    public string $documentURL;

    /**
     * URL to receive completion webhook.
     */
    #[Optional('callback_url')]
    public ?string $callbackURL;

    /**
     * Optional custom document identifier.
     */
    #[Optional('document_id')]
    public ?string $documentID;

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
    #[Optional('result_bucket')]
    public ?string $resultBucket;

    /**
     * S3 key prefix for results.
     */
    #[Optional('result_prefix')]
    public ?string $resultPrefix;

    /**
     * `new V1ProcessParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1ProcessParams::with(documentURL: ...)
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
        string $documentURL,
        ?string $callbackURL = null,
        ?string $documentID = null,
        Engine|string|null $engine = null,
        Features|array|null $features = null,
        ?string $resultBucket = null,
        ?string $resultPrefix = null,
    ): self {
        $obj = new self;

        $obj['documentURL'] = $documentURL;

        null !== $callbackURL && $obj['callbackURL'] = $callbackURL;
        null !== $documentID && $obj['documentID'] = $documentID;
        null !== $engine && $obj['engine'] = $engine;
        null !== $features && $obj['features'] = $features;
        null !== $resultBucket && $obj['resultBucket'] = $resultBucket;
        null !== $resultPrefix && $obj['resultPrefix'] = $resultPrefix;

        return $obj;
    }

    /**
     * URL or S3 path to the document to process.
     */
    public function withDocumentURL(string $documentURL): self
    {
        $obj = clone $this;
        $obj['documentURL'] = $documentURL;

        return $obj;
    }

    /**
     * URL to receive completion webhook.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $obj = clone $this;
        $obj['callbackURL'] = $callbackURL;

        return $obj;
    }

    /**
     * Optional custom document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $obj = clone $this;
        $obj['documentID'] = $documentID;

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
        $obj['resultBucket'] = $resultBucket;

        return $obj;
    }

    /**
     * S3 key prefix for results.
     */
    public function withResultPrefix(string $resultPrefix): self
    {
        $obj = clone $this;
        $obj['resultPrefix'] = $resultPrefix;

        return $obj;
    }
}
