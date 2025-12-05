<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Usage;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type UsageGetResponseShape = array{
 *   bandwidthBytes?: int|null,
 *   extensionUnitsCount?: int|null,
 *   mediaLibraryStorageBytes?: int|null,
 *   originalCacheStorageBytes?: int|null,
 *   videoProcessingUnitsCount?: int|null,
 * }
 */
final class UsageGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<UsageGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Amount of bandwidth used in bytes.
     */
    #[Api(optional: true)]
    public ?int $bandwidthBytes;

    /**
     * Number of extension units used.
     */
    #[Api(optional: true)]
    public ?int $extensionUnitsCount;

    /**
     * Storage used by media library in bytes.
     */
    #[Api(optional: true)]
    public ?int $mediaLibraryStorageBytes;

    /**
     * Storage used by the original cache in bytes.
     */
    #[Api(optional: true)]
    public ?int $originalCacheStorageBytes;

    /**
     * Number of video processing units used.
     */
    #[Api(optional: true)]
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
        $obj = new self;

        null !== $bandwidthBytes && $obj['bandwidthBytes'] = $bandwidthBytes;
        null !== $extensionUnitsCount && $obj['extensionUnitsCount'] = $extensionUnitsCount;
        null !== $mediaLibraryStorageBytes && $obj['mediaLibraryStorageBytes'] = $mediaLibraryStorageBytes;
        null !== $originalCacheStorageBytes && $obj['originalCacheStorageBytes'] = $originalCacheStorageBytes;
        null !== $videoProcessingUnitsCount && $obj['videoProcessingUnitsCount'] = $videoProcessingUnitsCount;

        return $obj;
    }

    /**
     * Amount of bandwidth used in bytes.
     */
    public function withBandwidthBytes(int $bandwidthBytes): self
    {
        $obj = clone $this;
        $obj['bandwidthBytes'] = $bandwidthBytes;

        return $obj;
    }

    /**
     * Number of extension units used.
     */
    public function withExtensionUnitsCount(int $extensionUnitsCount): self
    {
        $obj = clone $this;
        $obj['extensionUnitsCount'] = $extensionUnitsCount;

        return $obj;
    }

    /**
     * Storage used by media library in bytes.
     */
    public function withMediaLibraryStorageBytes(
        int $mediaLibraryStorageBytes
    ): self {
        $obj = clone $this;
        $obj['mediaLibraryStorageBytes'] = $mediaLibraryStorageBytes;

        return $obj;
    }

    /**
     * Storage used by the original cache in bytes.
     */
    public function withOriginalCacheStorageBytes(
        int $originalCacheStorageBytes
    ): self {
        $obj = clone $this;
        $obj['originalCacheStorageBytes'] = $originalCacheStorageBytes;

        return $obj;
    }

    /**
     * Number of video processing units used.
     */
    public function withVideoProcessingUnitsCount(
        int $videoProcessingUnitsCount
    ): self {
        $obj = clone $this;
        $obj['videoProcessingUnitsCount'] = $videoProcessingUnitsCount;

        return $obj;
    }
}
