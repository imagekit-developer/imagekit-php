<?php

declare(strict_types=1);

namespace ImageKit\Responses\Beta\V2\Files\FileUploadResponse\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Thumbnail information.
 *
 * @phpstan-type thumbnail_alias = array{
 *   compression?: int,
 *   resolutionUnit?: int,
 *   thumbnailLength?: int,
 *   thumbnailOffset?: int,
 *   xResolution?: int,
 *   yResolution?: int,
 * }
 */
final class Thumbnail implements BaseModel
{
    use SdkModel;

    #[Api('Compression', optional: true)]
    public ?int $compression;

    #[Api('ResolutionUnit', optional: true)]
    public ?int $resolutionUnit;

    #[Api('ThumbnailLength', optional: true)]
    public ?int $thumbnailLength;

    #[Api('ThumbnailOffset', optional: true)]
    public ?int $thumbnailOffset;

    #[Api('XResolution', optional: true)]
    public ?int $xResolution;

    #[Api('YResolution', optional: true)]
    public ?int $yResolution;

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
    public static function with(
        ?int $compression = null,
        ?int $resolutionUnit = null,
        ?int $thumbnailLength = null,
        ?int $thumbnailOffset = null,
        ?int $xResolution = null,
        ?int $yResolution = null,
    ): self {
        $obj = new self;

        null !== $compression && $obj->compression = $compression;
        null !== $resolutionUnit && $obj->resolutionUnit = $resolutionUnit;
        null !== $thumbnailLength && $obj->thumbnailLength = $thumbnailLength;
        null !== $thumbnailOffset && $obj->thumbnailOffset = $thumbnailOffset;
        null !== $xResolution && $obj->xResolution = $xResolution;
        null !== $yResolution && $obj->yResolution = $yResolution;

        return $obj;
    }

    public function withCompression(int $compression): self
    {
        $obj = clone $this;
        $obj->compression = $compression;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj->resolutionUnit = $resolutionUnit;

        return $obj;
    }

    public function withThumbnailLength(int $thumbnailLength): self
    {
        $obj = clone $this;
        $obj->thumbnailLength = $thumbnailLength;

        return $obj;
    }

    public function withThumbnailOffset(int $thumbnailOffset): self
    {
        $obj = clone $this;
        $obj->thumbnailOffset = $thumbnailOffset;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj->xResolution = $xResolution;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj->yResolution = $yResolution;

        return $obj;
    }
}
