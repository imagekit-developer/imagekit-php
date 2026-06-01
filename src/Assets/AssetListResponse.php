<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetListResponse\Item;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ItemVariants from \ImageKit\Assets\AssetListResponse\Item
 * @phpstan-import-type ItemShape from \ImageKit\Assets\AssetListResponse\Item
 *
 * @phpstan-type AssetListResponseShape = array{
 *   items: list<ItemShape>, endCursor?: string|null, startCursor?: string|null
 * }
 */
final class AssetListResponse implements BaseModel
{
    /** @use SdkModel<AssetListResponseShape> */
    use SdkModel;

    /**
     * Page of assets matching the query.
     *
     * @var list<ItemVariants> $items
     */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * Opaque cursor pointing to the last item in this page. Pass it back as the `cursor` query parameter to fetch the next page. `null` when there are no more results.
     */
    #[Optional('end_cursor', nullable: true)]
    public ?string $endCursor;

    /**
     * Opaque cursor pointing to the first item in this page. Pass it back as the `cursor` query parameter to fetch the previous page. `null` when this is the first page.
     */
    #[Optional('start_cursor', nullable: true)]
    public ?string $startCursor;

    /**
     * `new AssetListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetListResponse)->withItems(...)
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
     * @param list<ItemShape> $items
     */
    public static function with(
        array $items,
        ?string $endCursor = null,
        ?string $startCursor = null
    ): self {
        $self = new self;

        $self['items'] = $items;

        null !== $endCursor && $self['endCursor'] = $endCursor;
        null !== $startCursor && $self['startCursor'] = $startCursor;

        return $self;
    }

    /**
     * Page of assets matching the query.
     *
     * @param list<ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Opaque cursor pointing to the last item in this page. Pass it back as the `cursor` query parameter to fetch the next page. `null` when there are no more results.
     */
    public function withEndCursor(?string $endCursor): self
    {
        $self = clone $this;
        $self['endCursor'] = $endCursor;

        return $self;
    }

    /**
     * Opaque cursor pointing to the first item in this page. Pass it back as the `cursor` query parameter to fetch the previous page. `null` when this is the first page.
     */
    public function withStartCursor(?string $startCursor): self
    {
        $self = clone $this;
        $self['startCursor'] = $startCursor;

        return $self;
    }
}
