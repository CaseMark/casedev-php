<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultSearchParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Vault\VaultSearchParams\Filters\ObjectID;

/**
 * Filters to narrow search results to specific documents.
 *
 * @phpstan-import-type ObjectIDShape from \Casedev\Vault\VaultSearchParams\Filters\ObjectID
 *
 * @phpstan-type FiltersShape = array{objectID?: ObjectIDShape|null}
 */
final class Filters implements BaseModel
{
    /** @use SdkModel<FiltersShape> */
    use SdkModel;

    /**
     * Filter to specific document(s) by object ID. Accepts a single ID or array of IDs.
     *
     * @var string|list<string>|null $objectID
     */
    #[Optional('object_id', union: ObjectID::class)]
    public string|array|null $objectID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ObjectIDShape $objectID
     */
    public static function with(string|array|null $objectID = null): self
    {
        $self = new self;

        null !== $objectID && $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Filter to specific document(s) by object ID. Accepts a single ID or array of IDs.
     *
     * @param ObjectIDShape $objectID
     */
    public function withObjectID(string|array $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }
}
