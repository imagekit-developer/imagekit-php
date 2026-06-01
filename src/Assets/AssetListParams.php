<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
 *
 * @see ImageKit\Services\AssetsService::list()
 *
 * @phpstan-type AssetListParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   searchQuery?: string|null,
 *   sort?: null|Sort|value-of<Sort>,
 * }
 */
final class AssetListParams implements BaseModel
{
    /** @use SdkModel<AssetListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque cursor returned in the `start_cursor` or `end_cursor` field of a previous response. Pass it to fetch the next (or previous) page of results. Omit to start from the beginning.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * The maximum number of results to return in response.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     */
    #[Optional]
    public ?string $searchQuery;

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Sort|value-of<Sort>|null $sort
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $searchQuery = null,
        Sort|string|null $sort = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $searchQuery && $self['searchQuery'] = $searchQuery;
        null !== $sort && $self['sort'] = $sort;

        return $self;
    }

    /**
     * Opaque cursor returned in the `start_cursor` or `end_cursor` field of a previous response. Pass it to fetch the next (or previous) page of results. Omit to start from the beginning.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The maximum number of results to return in response.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     */
    public function withSearchQuery(string $searchQuery): self
    {
        $self = clone $this;
        $self['searchQuery'] = $searchQuery;

        return $self;
    }

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }
}
