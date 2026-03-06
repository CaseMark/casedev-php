<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1DraftParams\Length;
use CaseDev\Legal\V1\V1DraftParams\OutputType;

/**
 * Generate a legal document with structured inputs. Powered by an agent that handles research, formatting, citation verification, and vault upload. Returns a run ID for polling.
 *
 * @see CaseDev\Services\Legal\V1Service::draft()
 *
 * @phpstan-import-type LengthShape from \CaseDev\Legal\V1\V1DraftParams\Length
 *
 * @phpstan-type V1DraftParamsShape = array{
 *   instructions: string,
 *   vaultID: string,
 *   citations?: bool|null,
 *   format?: string|null,
 *   length?: null|Length|LengthShape,
 *   model?: string|null,
 *   objectIDs?: list<string>|null,
 *   outputName?: string|null,
 *   outputType?: null|OutputType|value-of<OutputType>,
 *   verified?: bool|null,
 * }
 */
final class V1DraftParams implements BaseModel
{
    /** @use SdkModel<V1DraftParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * What to draft — the core task. E.g., "Motion to compel defendant to produce discovery responses".
     */
    #[Required]
    public string $instructions;

    /**
     * Vault ID where the final document will be uploaded.
     */
    #[Required('vault_id')]
    public string $vaultID;

    /**
     * Research and include legal citations.
     */
    #[Optional]
    public ?bool $citations;

    /**
     * Court or jurisdiction formatting hint. Triggers a legal-skills search. E.g., "California Superior Court", "SDNY", "federal pleading".
     */
    #[Optional(nullable: true)]
    public ?string $format;

    /**
     * Target document length.
     */
    #[Optional(nullable: true)]
    public ?Length $length;

    /**
     * LLM model override. Defaults to anthropic/claude-sonnet-4.6.
     */
    #[Optional(nullable: true)]
    public ?string $model;

    /**
     * Vault object IDs to use as source/reference documents.
     *
     * @var list<string>|null $objectIDs
     */
    #[Optional('object_ids', list: 'string', nullable: true)]
    public ?array $objectIDs;

    /**
     * Filename for the output document. Auto-generated if omitted.
     */
    #[Optional('output_name', nullable: true)]
    public ?string $outputName;

    /**
     * Output file format.
     *
     * @var value-of<OutputType>|null $outputType
     */
    #[Optional('output_type', enum: OutputType::class)]
    public ?string $outputType;

    /**
     * Verify all citations in a loop — re-run verification and repair bad citations until they pass.
     */
    #[Optional]
    public ?bool $verified;

    /**
     * `new V1DraftParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DraftParams::with(instructions: ..., vaultID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DraftParams)->withInstructions(...)->withVaultID(...)
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
     * @param Length|LengthShape|null $length
     * @param list<string>|null $objectIDs
     * @param OutputType|value-of<OutputType>|null $outputType
     */
    public static function with(
        string $instructions,
        string $vaultID,
        ?bool $citations = null,
        ?string $format = null,
        Length|array|null $length = null,
        ?string $model = null,
        ?array $objectIDs = null,
        ?string $outputName = null,
        OutputType|string|null $outputType = null,
        ?bool $verified = null,
    ): self {
        $self = new self;

        $self['instructions'] = $instructions;
        $self['vaultID'] = $vaultID;

        null !== $citations && $self['citations'] = $citations;
        null !== $format && $self['format'] = $format;
        null !== $length && $self['length'] = $length;
        null !== $model && $self['model'] = $model;
        null !== $objectIDs && $self['objectIDs'] = $objectIDs;
        null !== $outputName && $self['outputName'] = $outputName;
        null !== $outputType && $self['outputType'] = $outputType;
        null !== $verified && $self['verified'] = $verified;

        return $self;
    }

    /**
     * What to draft — the core task. E.g., "Motion to compel defendant to produce discovery responses".
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Vault ID where the final document will be uploaded.
     */
    public function withVaultID(string $vaultID): self
    {
        $self = clone $this;
        $self['vaultID'] = $vaultID;

        return $self;
    }

    /**
     * Research and include legal citations.
     */
    public function withCitations(bool $citations): self
    {
        $self = clone $this;
        $self['citations'] = $citations;

        return $self;
    }

    /**
     * Court or jurisdiction formatting hint. Triggers a legal-skills search. E.g., "California Superior Court", "SDNY", "federal pleading".
     */
    public function withFormat(?string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Target document length.
     *
     * @param Length|LengthShape|null $length
     */
    public function withLength(Length|array|null $length): self
    {
        $self = clone $this;
        $self['length'] = $length;

        return $self;
    }

    /**
     * LLM model override. Defaults to anthropic/claude-sonnet-4.6.
     */
    public function withModel(?string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Vault object IDs to use as source/reference documents.
     *
     * @param list<string>|null $objectIDs
     */
    public function withObjectIDs(?array $objectIDs): self
    {
        $self = clone $this;
        $self['objectIDs'] = $objectIDs;

        return $self;
    }

    /**
     * Filename for the output document. Auto-generated if omitted.
     */
    public function withOutputName(?string $outputName): self
    {
        $self = clone $this;
        $self['outputName'] = $outputName;

        return $self;
    }

    /**
     * Output file format.
     *
     * @param OutputType|value-of<OutputType> $outputType
     */
    public function withOutputType(OutputType|string $outputType): self
    {
        $self = clone $this;
        $self['outputType'] = $outputType;

        return $self;
    }

    /**
     * Verify all citations in a loop — re-run verification and repair bad citations until they pass.
     */
    public function withVerified(bool $verified): self
    {
        $self = clone $this;
        $self['verified'] = $verified;

        return $self;
    }
}
