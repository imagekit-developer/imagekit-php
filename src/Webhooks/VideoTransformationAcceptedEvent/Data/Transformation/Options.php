<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options\AudioCodec;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options\Format;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options\StreamProtocol;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options\VideoCodec;

/**
 * Configuration options for video transformations.
 *
 * @phpstan-type options_alias = array{
 *   audioCodec?: AudioCodec::*|null,
 *   autoRotate?: bool|null,
 *   format?: Format::*|null,
 *   quality?: int|null,
 *   streamProtocol?: StreamProtocol::*|null,
 *   variants?: list<string>|null,
 *   videoCodec?: VideoCodec::*|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<options_alias> */
    use SdkModel;

    /**
     * Audio codec used for encoding (aac or opus).
     *
     * @var AudioCodec::*|null $audioCodec
     */
    #[Api('audio_codec', enum: AudioCodec::class, optional: true)]
    public ?string $audioCodec;

    /**
     * Whether to automatically rotate the video based on metadata.
     */
    #[Api('auto_rotate', optional: true)]
    public ?bool $autoRotate;

    /**
     * Output format for the transformed video or thumbnail.
     *
     * @var Format::*|null $format
     */
    #[Api(enum: Format::class, optional: true)]
    public ?string $format;

    /**
     * Quality setting for the output video.
     */
    #[Api(optional: true)]
    public ?int $quality;

    /**
     * Streaming protocol for adaptive bitrate streaming.
     *
     * @var StreamProtocol::*|null $streamProtocol
     */
    #[Api('stream_protocol', enum: StreamProtocol::class, optional: true)]
    public ?string $streamProtocol;

    /**
     * Array of quality representations for adaptive bitrate streaming.
     *
     * @var list<string>|null $variants
     */
    #[Api(list: 'string', optional: true)]
    public ?array $variants;

    /**
     * Video codec used for encoding (h264 or vp9).
     *
     * @var VideoCodec::*|null $videoCodec
     */
    #[Api('video_codec', enum: VideoCodec::class, optional: true)]
    public ?string $videoCodec;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudioCodec::* $audioCodec
     * @param Format::* $format
     * @param StreamProtocol::* $streamProtocol
     * @param list<string> $variants
     * @param VideoCodec::* $videoCodec
     */
    public static function with(
        ?string $audioCodec = null,
        ?bool $autoRotate = null,
        ?string $format = null,
        ?int $quality = null,
        ?string $streamProtocol = null,
        ?array $variants = null,
        ?string $videoCodec = null,
    ): self {
        $obj = new self;

        null !== $audioCodec && $obj->audioCodec = $audioCodec;
        null !== $autoRotate && $obj->autoRotate = $autoRotate;
        null !== $format && $obj->format = $format;
        null !== $quality && $obj->quality = $quality;
        null !== $streamProtocol && $obj->streamProtocol = $streamProtocol;
        null !== $variants && $obj->variants = $variants;
        null !== $videoCodec && $obj->videoCodec = $videoCodec;

        return $obj;
    }

    /**
     * Audio codec used for encoding (aac or opus).
     *
     * @param AudioCodec::* $audioCodec
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $obj = clone $this;
        $obj->audioCodec = $audioCodec;

        return $obj;
    }

    /**
     * Whether to automatically rotate the video based on metadata.
     */
    public function withAutoRotate(bool $autoRotate): self
    {
        $obj = clone $this;
        $obj->autoRotate = $autoRotate;

        return $obj;
    }

    /**
     * Output format for the transformed video or thumbnail.
     *
     * @param Format::* $format
     */
    public function withFormat(string $format): self
    {
        $obj = clone $this;
        $obj->format = $format;

        return $obj;
    }

    /**
     * Quality setting for the output video.
     */
    public function withQuality(int $quality): self
    {
        $obj = clone $this;
        $obj->quality = $quality;

        return $obj;
    }

    /**
     * Streaming protocol for adaptive bitrate streaming.
     *
     * @param StreamProtocol::* $streamProtocol
     */
    public function withStreamProtocol(string $streamProtocol): self
    {
        $obj = clone $this;
        $obj->streamProtocol = $streamProtocol;

        return $obj;
    }

    /**
     * Array of quality representations for adaptive bitrate streaming.
     *
     * @param list<string> $variants
     */
    public function withVariants(array $variants): self
    {
        $obj = clone $this;
        $obj->variants = $variants;

        return $obj;
    }

    /**
     * Video codec used for encoding (h264 or vp9).
     *
     * @param VideoCodec::* $videoCodec
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $obj = clone $this;
        $obj->videoCodec = $videoCodec;

        return $obj;
    }
}
