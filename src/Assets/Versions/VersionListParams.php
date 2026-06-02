<?php

declare(strict_types=1);

namespace ImageKit\Assets\Versions;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Returns details of all versions of a file.
 *
 * @see ImageKit\Services\Assets\VersionsService::list()
 *
 * @phpstan-type VersionListParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class VersionListParams implements BaseModel
{
    /** @use SdkModel<VersionListParamsShape> */
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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

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
}
