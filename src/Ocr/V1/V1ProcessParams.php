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
 * @phpstan-import-type FeaturesShape from \Casedev\Ocr\V1\V1ProcessParams\Features
 *
 * @phpstan-type V1ProcessParamsShape = array{
 *   documentURL: string,
 *   callbackURL?: string|null,
 *   documentID?: string|null,
 *   engine?: null|Engine|value-of<Engine>,
 *   features?: FeaturesShape|null,
 *   resultBucket?: string|null,
 *   resultPrefix?: string|null,
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
     * @param FeaturesShape $features
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
        $self = new self;

        $self['documentURL'] = $documentURL;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;
        null !== $documentID && $self['documentID'] = $documentID;
        null !== $engine && $self['engine'] = $engine;
        null !== $features && $self['features'] = $features;
        null !== $resultBucket && $self['resultBucket'] = $resultBucket;
        null !== $resultPrefix && $self['resultPrefix'] = $resultPrefix;

        return $self;
    }

    /**
     * URL or S3 path to the document to process.
     */
    public function withDocumentURL(string $documentURL): self
    {
        $self = clone $this;
        $self['documentURL'] = $documentURL;

        return $self;
    }

    /**
     * URL to receive completion webhook.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * Optional custom document identifier.
     */
    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }

    /**
     * OCR engine to use.
     *
     * @param Engine|value-of<Engine> $engine
     */
    public function withEngine(Engine|string $engine): self
    {
        $self = clone $this;
        $self['engine'] = $engine;

        return $self;
    }

    /**
     * OCR features to extract.
     *
     * @param FeaturesShape $features
     */
    public function withFeatures(Features|array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

        return $self;
    }

    /**
     * S3 bucket to store results.
     */
    public function withResultBucket(string $resultBucket): self
    {
        $self = clone $this;
        $self['resultBucket'] = $resultBucket;

        return $self;
    }

    /**
     * S3 key prefix for results.
     */
    public function withResultPrefix(string $resultPrefix): self
    {
        $self = clone $this;
        $self['resultPrefix'] = $resultPrefix;

        return $self;
    }
}
