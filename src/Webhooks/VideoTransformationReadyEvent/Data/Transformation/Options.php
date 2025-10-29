<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options\AudioCodec;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options\Format;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options\StreamProtocol;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options\VideoCodec;

/**
 * Configuration options for video transformations.
 *
 * @phpstan-type OptionsShape = array{
 *   audioCodec?: value-of<AudioCodec>,
 *   autoRotate?: bool,
 *   format?: value-of<Format>,
 *   quality?: int,
 *   streamProtocol?: value-of<StreamProtocol>,
 *   variants?: list<string>,
 *   videoCodec?: value-of<VideoCodec>,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Audio codec used for encoding (aac or opus).
     *
     * @var value-of<AudioCodec>|null $audioCodec
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
     * @var value-of<Format>|null $format
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
     * @var value-of<StreamProtocol>|null $streamProtocol
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
     * Video codec used for encoding (h264, vp9, or av1).
     *
     * @var value-of<VideoCodec>|null $videoCodec
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
     * @param AudioCodec|value-of<AudioCodec> $audioCodec
     * @param Format|value-of<Format> $format
     * @param StreamProtocol|value-of<StreamProtocol> $streamProtocol
     * @param list<string> $variants
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public static function with(
        AudioCodec|string|null $audioCodec = null,
        ?bool $autoRotate = null,
        Format|string|null $format = null,
        ?int $quality = null,
        StreamProtocol|string|null $streamProtocol = null,
        ?array $variants = null,
        VideoCodec|string|null $videoCodec = null,
    ): self {
        $obj = new self;

        null !== $audioCodec && $obj['audioCodec'] = $audioCodec;
        null !== $autoRotate && $obj->autoRotate = $autoRotate;
        null !== $format && $obj['format'] = $format;
        null !== $quality && $obj->quality = $quality;
        null !== $streamProtocol && $obj['streamProtocol'] = $streamProtocol;
        null !== $variants && $obj->variants = $variants;
        null !== $videoCodec && $obj['videoCodec'] = $videoCodec;

        return $obj;
    }

    /**
     * Audio codec used for encoding (aac or opus).
     *
     * @param AudioCodec|value-of<AudioCodec> $audioCodec
     */
    public function withAudioCodec(AudioCodec|string $audioCodec): self
    {
        $obj = clone $this;
        $obj['audioCodec'] = $audioCodec;

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
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $obj = clone $this;
        $obj['format'] = $format;

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
     * @param StreamProtocol|value-of<StreamProtocol> $streamProtocol
     */
    public function withStreamProtocol(
        StreamProtocol|string $streamProtocol
    ): self {
        $obj = clone $this;
        $obj['streamProtocol'] = $streamProtocol;

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
     * Video codec used for encoding (h264, vp9, or av1).
     *
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public function withVideoCodec(VideoCodec|string $videoCodec): self
    {
        $obj = clone $this;
        $obj['videoCodec'] = $videoCodec;

        return $obj;
    }
}
