<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV1Response\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
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
    use Model;

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
    public static function new(
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

    public function setCompression(int $compression): self
    {
        $this->compression = $compression;

        return $this;
    }

    public function setResolutionUnit(int $resolutionUnit): self
    {
        $this->resolutionUnit = $resolutionUnit;

        return $this;
    }

    public function setThumbnailLength(int $thumbnailLength): self
    {
        $this->thumbnailLength = $thumbnailLength;

        return $this;
    }

    public function setThumbnailOffset(int $thumbnailOffset): self
    {
        $this->thumbnailOffset = $thumbnailOffset;

        return $this;
    }

    public function setXResolution(int $xResolution): self
    {
        $this->xResolution = $xResolution;

        return $this;
    }

    public function setYResolution(int $yResolution): self
    {
        $this->yResolution = $yResolution;

        return $this;
    }
}
