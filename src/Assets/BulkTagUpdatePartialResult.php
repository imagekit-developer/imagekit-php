<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\BulkTagUpdatePartialResult\Error;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ErrorShape from \ImageKit\Assets\BulkTagUpdatePartialResult\Error
 *
 * @phpstan-type BulkTagUpdatePartialResultShape = array{
 *   errors: list<Error|ErrorShape>, successfulAssetIDs: list<string>
 * }
 */
final class BulkTagUpdatePartialResult implements BaseModel
{
    /** @use SdkModel<BulkTagUpdatePartialResultShape> */
    use SdkModel;

    /**
     * Per-asset failures for the partially successful request.
     *
     * @var list<Error> $errors
     */
    #[Required(list: Error::class)]
    public array $errors;

    /**
     * Array of `asset_id`s whose tags were updated successfully.
     *
     * @var list<string> $successfulAssetIDs
     */
    #[Required('successful_asset_ids', list: 'string')]
    public array $successfulAssetIDs;

    /**
     * `new BulkTagUpdatePartialResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkTagUpdatePartialResult::with(errors: ..., successfulAssetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkTagUpdatePartialResult)->withErrors(...)->withSuccessfulAssetIDs(...)
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
     * @param list<Error|ErrorShape> $errors
     * @param list<string> $successfulAssetIDs
     */
    public static function with(array $errors, array $successfulAssetIDs): self
    {
        $self = new self;

        $self['errors'] = $errors;
        $self['successfulAssetIDs'] = $successfulAssetIDs;

        return $self;
    }

    /**
     * Per-asset failures for the partially successful request.
     *
     * @param list<Error|ErrorShape> $errors
     */
    public function withErrors(array $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    /**
     * Array of `asset_id`s whose tags were updated successfully.
     *
     * @param list<string> $successfulAssetIDs
     */
    public function withSuccessfulAssetIDs(array $successfulAssetIDs): self
    {
        $self = clone $this;
        $self['successfulAssetIDs'] = $successfulAssetIDs;

        return $self;
    }
}
