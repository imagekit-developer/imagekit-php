<?php

declare(strict_types=1);

namespace ImageKit\Assets\Versions;

use ImageKit\Assets\FileVersionDetails;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type FileVersionDetailsShape from \ImageKit\Assets\FileVersionDetails
 *
 * @phpstan-type VersionListResponseShape = array{
 *   items: list<FileVersionDetails|FileVersionDetailsShape>,
 *   endCursor?: string|null,
 *   startCursor?: string|null,
 * }
 */
final class VersionListResponse implements BaseModel
{
    /** @use SdkModel<VersionListResponseShape> */
    use SdkModel;

    /**
     * Page of file versions for the given file.
     *
     * @var list<FileVersionDetails> $items
     */
    #[Required(list: FileVersionDetails::class)]
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
     * `new VersionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionListResponse)->withItems(...)
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
     * @param list<FileVersionDetails|FileVersionDetailsShape> $items
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
     * Page of file versions for the given file.
     *
     * @param list<FileVersionDetails|FileVersionDetailsShape> $items
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
