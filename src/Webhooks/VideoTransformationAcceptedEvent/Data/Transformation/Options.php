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
 * @phpstan-type OptionsShape = array{
 *   audio_codec?: value-of<AudioCodec>|null,
 *   auto_rotate?: bool|null,
 *   format?: value-of<Format>|null,
 *   quality?: int|null,
 *   stream_protocol?: value-of<StreamProtocol>|null,
 *   variants?: list<string>|null,
 *   video_codec?: value-of<VideoCodec>|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Audio codec used for encoding (aac or opus).
     *
     * @var value-of<AudioCodec>|null $audio_codec
     */
    #[Api(enum: AudioCodec::class, optional: true)]
    public ?string $audio_codec;

    /**
     * Whether to automatically rotate the video based on metadata.
     */
    #[Api(optional: true)]
    public ?bool $auto_rotate;

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
     * @var value-of<StreamProtocol>|null $stream_protocol
     */
    #[Api(enum: StreamProtocol::class, optional: true)]
    public ?string $stream_protocol;

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
     * @var value-of<VideoCodec>|null $video_codec
     */
    #[Api(enum: VideoCodec::class, optional: true)]
    public ?string $video_codec;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudioCodec|value-of<AudioCodec> $audio_codec
     * @param Format|value-of<Format> $format
     * @param StreamProtocol|value-of<StreamProtocol> $stream_protocol
     * @param list<string> $variants
     * @param VideoCodec|value-of<VideoCodec> $video_codec
     */
    public static function with(
        AudioCodec|string|null $audio_codec = null,
        ?bool $auto_rotate = null,
        Format|string|null $format = null,
        ?int $quality = null,
        StreamProtocol|string|null $stream_protocol = null,
        ?array $variants = null,
        VideoCodec|string|null $video_codec = null,
    ): self {
        $obj = new self;

        null !== $audio_codec && $obj['audio_codec'] = $audio_codec;
        null !== $auto_rotate && $obj->auto_rotate = $auto_rotate;
        null !== $format && $obj['format'] = $format;
        null !== $quality && $obj->quality = $quality;
        null !== $stream_protocol && $obj['stream_protocol'] = $stream_protocol;
        null !== $variants && $obj->variants = $variants;
        null !== $video_codec && $obj['video_codec'] = $video_codec;

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
        $obj['audio_codec'] = $audioCodec;

        return $obj;
    }

    /**
     * Whether to automatically rotate the video based on metadata.
     */
    public function withAutoRotate(bool $autoRotate): self
    {
        $obj = clone $this;
        $obj->auto_rotate = $autoRotate;

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
        $obj['stream_protocol'] = $streamProtocol;

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
        $obj['video_codec'] = $videoCodec;

        return $obj;
    }
}
