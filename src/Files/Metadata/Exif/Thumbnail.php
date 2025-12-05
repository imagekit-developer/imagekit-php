<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Thumbnail information.
 *
 * @phpstan-type ThumbnailShape = array{
 *   Compression?: int|null,
 *   ResolutionUnit?: int|null,
 *   ThumbnailLength?: int|null,
 *   ThumbnailOffset?: int|null,
 *   XResolution?: int|null,
 *   YResolution?: int|null,
 * }
 */
final class Thumbnail implements BaseModel
{
    /** @use SdkModel<ThumbnailShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?int $Compression;

    #[Api(optional: true)]
    public ?int $ResolutionUnit;

    #[Api(optional: true)]
    public ?int $ThumbnailLength;

    #[Api(optional: true)]
    public ?int $ThumbnailOffset;

    #[Api(optional: true)]
    public ?int $XResolution;

    #[Api(optional: true)]
    public ?int $YResolution;

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
        ?int $Compression = null,
        ?int $ResolutionUnit = null,
        ?int $ThumbnailLength = null,
        ?int $ThumbnailOffset = null,
        ?int $XResolution = null,
        ?int $YResolution = null,
    ): self {
        $obj = new self;

        null !== $Compression && $obj['Compression'] = $Compression;
        null !== $ResolutionUnit && $obj['ResolutionUnit'] = $ResolutionUnit;
        null !== $ThumbnailLength && $obj['ThumbnailLength'] = $ThumbnailLength;
        null !== $ThumbnailOffset && $obj['ThumbnailOffset'] = $ThumbnailOffset;
        null !== $XResolution && $obj['XResolution'] = $XResolution;
        null !== $YResolution && $obj['YResolution'] = $YResolution;

        return $obj;
    }

    public function withCompression(int $compression): self
    {
        $obj = clone $this;
        $obj['Compression'] = $compression;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj['ResolutionUnit'] = $resolutionUnit;

        return $obj;
    }

    public function withThumbnailLength(int $thumbnailLength): self
    {
        $obj = clone $this;
        $obj['ThumbnailLength'] = $thumbnailLength;

        return $obj;
    }

    public function withThumbnailOffset(int $thumbnailOffset): self
    {
        $obj = clone $this;
        $obj['ThumbnailOffset'] = $thumbnailOffset;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj['XResolution'] = $xResolution;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj['YResolution'] = $yResolution;

        return $obj;
    }
}
