<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type account_get_usage_response_alias = array{
 *   bandwidthBytes?: int,
 *   extensionUnitsCount?: int,
 *   mediaLibraryStorageBytes?: int,
 *   originalCacheStorageBytes?: int,
 *   videoProcessingUnitsCount?: int,
 * }
 */
final class AccountGetUsageResponse implements BaseModel
{
    use Model;

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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function new(
        ?int $bandwidthBytes = null,
        ?int $extensionUnitsCount = null,
        ?int $mediaLibraryStorageBytes = null,
        ?int $originalCacheStorageBytes = null,
        ?int $videoProcessingUnitsCount = null,
    ): self {
        $obj = new self;

        null !== $bandwidthBytes && $obj->bandwidthBytes = $bandwidthBytes;
        null !== $extensionUnitsCount && $obj->extensionUnitsCount = $extensionUnitsCount;
        null !== $mediaLibraryStorageBytes && $obj->mediaLibraryStorageBytes = $mediaLibraryStorageBytes;
        null !== $originalCacheStorageBytes && $obj->originalCacheStorageBytes = $originalCacheStorageBytes;
        null !== $videoProcessingUnitsCount && $obj->videoProcessingUnitsCount = $videoProcessingUnitsCount;

        return $obj;
    }

    /**
     * Amount of bandwidth used in bytes.
     */
    public function setBandwidthBytes(int $bandwidthBytes): self
    {
        $this->bandwidthBytes = $bandwidthBytes;

        return $this;
    }

    /**
     * Number of extension units used.
     */
    public function setExtensionUnitsCount(int $extensionUnitsCount): self
    {
        $this->extensionUnitsCount = $extensionUnitsCount;

        return $this;
    }

    /**
     * Storage used by media library in bytes.
     */
    public function setMediaLibraryStorageBytes(
        int $mediaLibraryStorageBytes
    ): self {
        $this->mediaLibraryStorageBytes = $mediaLibraryStorageBytes;

        return $this;
    }

    /**
     * Storage used by the original cache in bytes.
     */
    public function setOriginalCacheStorageBytes(
        int $originalCacheStorageBytes
    ): self {
        $this->originalCacheStorageBytes = $originalCacheStorageBytes;

        return $this;
    }

    /**
     * Number of video processing units used.
     */
    public function setVideoProcessingUnitsCount(
        int $videoProcessingUnitsCount
    ): self {
        $this->videoProcessingUnitsCount = $videoProcessingUnitsCount;

        return $this;
    }
}
