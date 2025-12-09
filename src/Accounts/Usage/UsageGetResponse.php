<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Usage;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageGetResponseShape = array{
 *   bandwidthBytes?: int|null,
 *   extensionUnitsCount?: int|null,
 *   mediaLibraryStorageBytes?: int|null,
 *   originalCacheStorageBytes?: int|null,
 *   videoProcessingUnitsCount?: int|null,
 * }
 */
final class UsageGetResponse implements BaseModel
{
    /** @use SdkModel<UsageGetResponseShape> */
    use SdkModel;

    /**
     * Amount of bandwidth used in bytes.
     */
    #[Optional]
    public ?int $bandwidthBytes;

    /**
     * Number of extension units used.
     */
    #[Optional]
    public ?int $extensionUnitsCount;

    /**
     * Storage used by media library in bytes.
     */
    #[Optional]
    public ?int $mediaLibraryStorageBytes;

    /**
     * Storage used by the original cache in bytes.
     */
    #[Optional]
    public ?int $originalCacheStorageBytes;

    /**
     * Number of video processing units used.
     */
    #[Optional]
    public ?int $videoProcessingUnitsCount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $bandwidthBytes = null,
        ?int $extensionUnitsCount = null,
        ?int $mediaLibraryStorageBytes = null,
        ?int $originalCacheStorageBytes = null,
        ?int $videoProcessingUnitsCount = null,
    ): self {
        $self = new self;

        null !== $bandwidthBytes && $self['bandwidthBytes'] = $bandwidthBytes;
        null !== $extensionUnitsCount && $self['extensionUnitsCount'] = $extensionUnitsCount;
        null !== $mediaLibraryStorageBytes && $self['mediaLibraryStorageBytes'] = $mediaLibraryStorageBytes;
        null !== $originalCacheStorageBytes && $self['originalCacheStorageBytes'] = $originalCacheStorageBytes;
        null !== $videoProcessingUnitsCount && $self['videoProcessingUnitsCount'] = $videoProcessingUnitsCount;

        return $self;
    }

    /**
     * Amount of bandwidth used in bytes.
     */
    public function withBandwidthBytes(int $bandwidthBytes): self
    {
        $self = clone $this;
        $self['bandwidthBytes'] = $bandwidthBytes;

        return $self;
    }

    /**
     * Number of extension units used.
     */
    public function withExtensionUnitsCount(int $extensionUnitsCount): self
    {
        $self = clone $this;
        $self['extensionUnitsCount'] = $extensionUnitsCount;

        return $self;
    }

    /**
     * Storage used by media library in bytes.
     */
    public function withMediaLibraryStorageBytes(
        int $mediaLibraryStorageBytes
    ): self {
        $self = clone $this;
        $self['mediaLibraryStorageBytes'] = $mediaLibraryStorageBytes;

        return $self;
    }

    /**
     * Storage used by the original cache in bytes.
     */
    public function withOriginalCacheStorageBytes(
        int $originalCacheStorageBytes
    ): self {
        $self = clone $this;
        $self['originalCacheStorageBytes'] = $originalCacheStorageBytes;

        return $self;
    }

    /**
     * Number of video processing units used.
     */
    public function withVideoProcessingUnitsCount(
        int $videoProcessingUnitsCount
    ): self {
        $self = clone $this;
        $self['videoProcessingUnitsCount'] = $videoProcessingUnitsCount;

        return $self;
    }
}
