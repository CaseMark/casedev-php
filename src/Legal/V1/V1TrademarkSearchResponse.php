<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Legal\V1\V1TrademarkSearchResponse\GoodsAndService;
use CaseDev\Legal\V1\V1TrademarkSearchResponse\Owner;

/**
 * @phpstan-import-type GoodsAndServiceShape from \CaseDev\Legal\V1\V1TrademarkSearchResponse\GoodsAndService
 * @phpstan-import-type OwnerShape from \CaseDev\Legal\V1\V1TrademarkSearchResponse\Owner
 *
 * @phpstan-type V1TrademarkSearchResponseShape = array{
 *   attorney?: string|null,
 *   filingDate?: string|null,
 *   goodsAndServices?: list<GoodsAndService|GoodsAndServiceShape>|null,
 *   imageURL?: string|null,
 *   markText?: string|null,
 *   markType?: string|null,
 *   niceClasses?: list<int>|null,
 *   owner?: null|Owner|OwnerShape,
 *   registrationDate?: string|null,
 *   registrationNumber?: string|null,
 *   serialNumber?: string|null,
 *   status?: string|null,
 *   statusDate?: string|null,
 *   usptoURL?: string|null,
 * }
 */
final class V1TrademarkSearchResponse implements BaseModel
{
    /** @use SdkModel<V1TrademarkSearchResponseShape> */
    use SdkModel;

    /**
     * Attorney of record.
     */
    #[Optional(nullable: true)]
    public ?string $attorney;

    /**
     * Date the application was filed.
     */
    #[Optional(nullable: true)]
    public ?string $filingDate;

    /**
     * Goods and services descriptions with class numbers.
     *
     * @var list<GoodsAndService>|null $goodsAndServices
     */
    #[Optional(list: GoodsAndService::class)]
    public ?array $goodsAndServices;

    /**
     * URL to the mark image on USPTO CDN.
     */
    #[Optional('imageUrl', nullable: true)]
    public ?string $imageURL;

    /**
     * The text of the trademark.
     */
    #[Optional(nullable: true)]
    public ?string $markText;

    /**
     * Type of mark (e.g. "Standard Character Mark", "Design Mark").
     */
    #[Optional(nullable: true)]
    public ?string $markType;

    /**
     * Nice classification class numbers.
     *
     * @var list<int>|null $niceClasses
     */
    #[Optional(list: 'int')]
    public ?array $niceClasses;

    /**
     * Current owner/applicant information.
     */
    #[Optional(nullable: true)]
    public ?Owner $owner;

    /**
     * Date the mark was registered.
     */
    #[Optional(nullable: true)]
    public ?string $registrationDate;

    /**
     * USPTO registration number (if registered).
     */
    #[Optional(nullable: true)]
    public ?string $registrationNumber;

    /**
     * USPTO serial number.
     */
    #[Optional]
    public ?string $serialNumber;

    /**
     * Current status (e.g. "Registered", "Pending", "Abandoned", "Cancelled").
     */
    #[Optional(nullable: true)]
    public ?string $status;

    /**
     * Date of most recent status update.
     */
    #[Optional(nullable: true)]
    public ?string $statusDate;

    /**
     * Canonical TSDR link for this mark.
     */
    #[Optional('usptoUrl')]
    public ?string $usptoURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<GoodsAndService|GoodsAndServiceShape>|null $goodsAndServices
     * @param list<int>|null $niceClasses
     * @param Owner|OwnerShape|null $owner
     */
    public static function with(
        ?string $attorney = null,
        ?string $filingDate = null,
        ?array $goodsAndServices = null,
        ?string $imageURL = null,
        ?string $markText = null,
        ?string $markType = null,
        ?array $niceClasses = null,
        Owner|array|null $owner = null,
        ?string $registrationDate = null,
        ?string $registrationNumber = null,
        ?string $serialNumber = null,
        ?string $status = null,
        ?string $statusDate = null,
        ?string $usptoURL = null,
    ): self {
        $self = new self;

        null !== $attorney && $self['attorney'] = $attorney;
        null !== $filingDate && $self['filingDate'] = $filingDate;
        null !== $goodsAndServices && $self['goodsAndServices'] = $goodsAndServices;
        null !== $imageURL && $self['imageURL'] = $imageURL;
        null !== $markText && $self['markText'] = $markText;
        null !== $markType && $self['markType'] = $markType;
        null !== $niceClasses && $self['niceClasses'] = $niceClasses;
        null !== $owner && $self['owner'] = $owner;
        null !== $registrationDate && $self['registrationDate'] = $registrationDate;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $serialNumber && $self['serialNumber'] = $serialNumber;
        null !== $status && $self['status'] = $status;
        null !== $statusDate && $self['statusDate'] = $statusDate;
        null !== $usptoURL && $self['usptoURL'] = $usptoURL;

        return $self;
    }

    /**
     * Attorney of record.
     */
    public function withAttorney(?string $attorney): self
    {
        $self = clone $this;
        $self['attorney'] = $attorney;

        return $self;
    }

    /**
     * Date the application was filed.
     */
    public function withFilingDate(?string $filingDate): self
    {
        $self = clone $this;
        $self['filingDate'] = $filingDate;

        return $self;
    }

    /**
     * Goods and services descriptions with class numbers.
     *
     * @param list<GoodsAndService|GoodsAndServiceShape> $goodsAndServices
     */
    public function withGoodsAndServices(array $goodsAndServices): self
    {
        $self = clone $this;
        $self['goodsAndServices'] = $goodsAndServices;

        return $self;
    }

    /**
     * URL to the mark image on USPTO CDN.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * The text of the trademark.
     */
    public function withMarkText(?string $markText): self
    {
        $self = clone $this;
        $self['markText'] = $markText;

        return $self;
    }

    /**
     * Type of mark (e.g. "Standard Character Mark", "Design Mark").
     */
    public function withMarkType(?string $markType): self
    {
        $self = clone $this;
        $self['markType'] = $markType;

        return $self;
    }

    /**
     * Nice classification class numbers.
     *
     * @param list<int> $niceClasses
     */
    public function withNiceClasses(array $niceClasses): self
    {
        $self = clone $this;
        $self['niceClasses'] = $niceClasses;

        return $self;
    }

    /**
     * Current owner/applicant information.
     *
     * @param Owner|OwnerShape|null $owner
     */
    public function withOwner(Owner|array|null $owner): self
    {
        $self = clone $this;
        $self['owner'] = $owner;

        return $self;
    }

    /**
     * Date the mark was registered.
     */
    public function withRegistrationDate(?string $registrationDate): self
    {
        $self = clone $this;
        $self['registrationDate'] = $registrationDate;

        return $self;
    }

    /**
     * USPTO registration number (if registered).
     */
    public function withRegistrationNumber(?string $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    /**
     * USPTO serial number.
     */
    public function withSerialNumber(string $serialNumber): self
    {
        $self = clone $this;
        $self['serialNumber'] = $serialNumber;

        return $self;
    }

    /**
     * Current status (e.g. "Registered", "Pending", "Abandoned", "Cancelled").
     */
    public function withStatus(?string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Date of most recent status update.
     */
    public function withStatusDate(?string $statusDate): self
    {
        $self = clone $this;
        $self['statusDate'] = $statusDate;

        return $self;
    }

    /**
     * Canonical TSDR link for this mark.
     */
    public function withUsptoURL(string $usptoURL): self
    {
        $self = clone $this;
        $self['usptoURL'] = $usptoURL;

        return $self;
    }
}
