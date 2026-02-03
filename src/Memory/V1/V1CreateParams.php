<?php

declare(strict_types=1);

namespace Casedev\Memory\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Memory\V1\V1CreateParams\Message;

/**
 * Store memories from conversation messages. Automatically extracts facts and handles deduplication.
 *
 * Use tag_1 through tag_12 for filtering - these are generic indexed fields you can use for any purpose:
 * - Legal app: tag_1=client_id, tag_2=matter_id
 * - Healthcare: tag_1=patient_id, tag_2=encounter_id
 * - E-commerce: tag_1=customer_id, tag_2=order_id
 *
 * @see Casedev\Services\Memory\V1Service::create()
 *
 * @phpstan-import-type MessageShape from \Casedev\Memory\V1\V1CreateParams\Message
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   messages: list<Message|MessageShape>,
 *   category?: string|null,
 *   extractionPrompt?: string|null,
 *   infer?: bool|null,
 *   metadata?: array<string,mixed>|null,
 *   tag1?: string|null,
 *   tag10?: string|null,
 *   tag11?: string|null,
 *   tag12?: string|null,
 *   tag2?: string|null,
 *   tag3?: string|null,
 *   tag4?: string|null,
 *   tag5?: string|null,
 *   tag6?: string|null,
 *   tag7?: string|null,
 *   tag8?: string|null,
 *   tag9?: string|null,
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Conversation messages to extract memories from.
     *
     * @var list<Message> $messages
     */
    #[Required(list: Message::class)]
    public array $messages;

    /**
     * Custom category (e.g., "fact", "preference", "deadline").
     */
    #[Optional]
    public ?string $category;

    /**
     * Optional custom prompt for fact extraction.
     */
    #[Optional('extraction_prompt')]
    public ?string $extractionPrompt;

    /**
     * Whether to extract facts from messages (default: true).
     */
    #[Optional]
    public ?bool $infer;

    /**
     * Additional metadata (not indexed).
     *
     * @var array<string,mixed>|null $metadata
     */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /**
     * Generic indexed filter field 1 (you decide what it means).
     */
    #[Optional('tag_1')]
    public ?string $tag1;

    /**
     * Generic indexed filter field 10.
     */
    #[Optional('tag_10')]
    public ?string $tag10;

    /**
     * Generic indexed filter field 11.
     */
    #[Optional('tag_11')]
    public ?string $tag11;

    /**
     * Generic indexed filter field 12.
     */
    #[Optional('tag_12')]
    public ?string $tag12;

    /**
     * Generic indexed filter field 2.
     */
    #[Optional('tag_2')]
    public ?string $tag2;

    /**
     * Generic indexed filter field 3.
     */
    #[Optional('tag_3')]
    public ?string $tag3;

    /**
     * Generic indexed filter field 4.
     */
    #[Optional('tag_4')]
    public ?string $tag4;

    /**
     * Generic indexed filter field 5.
     */
    #[Optional('tag_5')]
    public ?string $tag5;

    /**
     * Generic indexed filter field 6.
     */
    #[Optional('tag_6')]
    public ?string $tag6;

    /**
     * Generic indexed filter field 7.
     */
    #[Optional('tag_7')]
    public ?string $tag7;

    /**
     * Generic indexed filter field 8.
     */
    #[Optional('tag_8')]
    public ?string $tag8;

    /**
     * Generic indexed filter field 9.
     */
    #[Optional('tag_9')]
    public ?string $tag9;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(messages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withMessages(...)
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
     * @param list<Message|MessageShape> $messages
     * @param array<string,mixed>|null $metadata
     */
    public static function with(
        array $messages,
        ?string $category = null,
        ?string $extractionPrompt = null,
        ?bool $infer = null,
        ?array $metadata = null,
        ?string $tag1 = null,
        ?string $tag10 = null,
        ?string $tag11 = null,
        ?string $tag12 = null,
        ?string $tag2 = null,
        ?string $tag3 = null,
        ?string $tag4 = null,
        ?string $tag5 = null,
        ?string $tag6 = null,
        ?string $tag7 = null,
        ?string $tag8 = null,
        ?string $tag9 = null,
    ): self {
        $self = new self;

        $self['messages'] = $messages;

        null !== $category && $self['category'] = $category;
        null !== $extractionPrompt && $self['extractionPrompt'] = $extractionPrompt;
        null !== $infer && $self['infer'] = $infer;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $tag1 && $self['tag1'] = $tag1;
        null !== $tag10 && $self['tag10'] = $tag10;
        null !== $tag11 && $self['tag11'] = $tag11;
        null !== $tag12 && $self['tag12'] = $tag12;
        null !== $tag2 && $self['tag2'] = $tag2;
        null !== $tag3 && $self['tag3'] = $tag3;
        null !== $tag4 && $self['tag4'] = $tag4;
        null !== $tag5 && $self['tag5'] = $tag5;
        null !== $tag6 && $self['tag6'] = $tag6;
        null !== $tag7 && $self['tag7'] = $tag7;
        null !== $tag8 && $self['tag8'] = $tag8;
        null !== $tag9 && $self['tag9'] = $tag9;

        return $self;
    }

    /**
     * Conversation messages to extract memories from.
     *
     * @param list<Message|MessageShape> $messages
     */
    public function withMessages(array $messages): self
    {
        $self = clone $this;
        $self['messages'] = $messages;

        return $self;
    }

    /**
     * Custom category (e.g., "fact", "preference", "deadline").
     */
    public function withCategory(string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Optional custom prompt for fact extraction.
     */
    public function withExtractionPrompt(string $extractionPrompt): self
    {
        $self = clone $this;
        $self['extractionPrompt'] = $extractionPrompt;

        return $self;
    }

    /**
     * Whether to extract facts from messages (default: true).
     */
    public function withInfer(bool $infer): self
    {
        $self = clone $this;
        $self['infer'] = $infer;

        return $self;
    }

    /**
     * Additional metadata (not indexed).
     *
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Generic indexed filter field 1 (you decide what it means).
     */
    public function withTag1(string $tag1): self
    {
        $self = clone $this;
        $self['tag1'] = $tag1;

        return $self;
    }

    /**
     * Generic indexed filter field 10.
     */
    public function withTag10(string $tag10): self
    {
        $self = clone $this;
        $self['tag10'] = $tag10;

        return $self;
    }

    /**
     * Generic indexed filter field 11.
     */
    public function withTag11(string $tag11): self
    {
        $self = clone $this;
        $self['tag11'] = $tag11;

        return $self;
    }

    /**
     * Generic indexed filter field 12.
     */
    public function withTag12(string $tag12): self
    {
        $self = clone $this;
        $self['tag12'] = $tag12;

        return $self;
    }

    /**
     * Generic indexed filter field 2.
     */
    public function withTag2(string $tag2): self
    {
        $self = clone $this;
        $self['tag2'] = $tag2;

        return $self;
    }

    /**
     * Generic indexed filter field 3.
     */
    public function withTag3(string $tag3): self
    {
        $self = clone $this;
        $self['tag3'] = $tag3;

        return $self;
    }

    /**
     * Generic indexed filter field 4.
     */
    public function withTag4(string $tag4): self
    {
        $self = clone $this;
        $self['tag4'] = $tag4;

        return $self;
    }

    /**
     * Generic indexed filter field 5.
     */
    public function withTag5(string $tag5): self
    {
        $self = clone $this;
        $self['tag5'] = $tag5;

        return $self;
    }

    /**
     * Generic indexed filter field 6.
     */
    public function withTag6(string $tag6): self
    {
        $self = clone $this;
        $self['tag6'] = $tag6;

        return $self;
    }

    /**
     * Generic indexed filter field 7.
     */
    public function withTag7(string $tag7): self
    {
        $self = clone $this;
        $self['tag7'] = $tag7;

        return $self;
    }

    /**
     * Generic indexed filter field 8.
     */
    public function withTag8(string $tag8): self
    {
        $self = clone $this;
        $self['tag8'] = $tag8;

        return $self;
    }

    /**
     * Generic indexed filter field 9.
     */
    public function withTag9(string $tag9): self
    {
        $self = clone $this;
        $self['tag9'] = $tag9;

        return $self;
    }
}
