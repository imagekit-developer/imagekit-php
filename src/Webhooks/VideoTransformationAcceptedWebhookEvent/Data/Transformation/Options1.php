<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options\AudioCodec;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options\Format;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options\StreamProtocol;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options\VideoCodec;

/**
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

    /** @var AudioCodec::*|null $audioCodec */
    #[Api('audio_codec', enum: AudioCodec::class, optional: true)]
    public ?string $audioCodec;

    #[Api('auto_rotate', optional: true)]
    public ?bool $autoRotate;

    /** @var Format::*|null $format */
    #[Api(enum: Format::class, optional: true)]
    public ?string $format;

    #[Api(optional: true)]
    public ?int $quality;

    /** @var StreamProtocol::*|null $streamProtocol */
    #[Api('stream_protocol', enum: StreamProtocol::class, optional: true)]
    public ?string $streamProtocol;

    /** @var list<string>|null $variants */
    #[Api(list: 'string', optional: true)]
    public ?array $variants;

    /** @var VideoCodec::*|null $videoCodec */
    #[Api('video_codec', enum: VideoCodec::class, optional: true)]
    public ?string $videoCodec;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
     * @param AudioCodec::* $audioCodec
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $obj = clone $this;
        $obj->audioCodec = $audioCodec;

        return $obj;
    }

    public function withAutoRotate(bool $autoRotate): self
    {
        $obj = clone $this;
        $obj->autoRotate = $autoRotate;

        return $obj;
    }

    /**
     * @param Format::* $format
     */
    public function withFormat(string $format): self
    {
        $obj = clone $this;
        $obj->format = $format;

        return $obj;
    }

    public function withQuality(int $quality): self
    {
        $obj = clone $this;
        $obj->quality = $quality;

        return $obj;
    }

    /**
     * @param StreamProtocol::* $streamProtocol
     */
    public function withStreamProtocol(string $streamProtocol): self
    {
        $obj = clone $this;
        $obj->streamProtocol = $streamProtocol;

        return $obj;
    }

    /**
     * @param list<string> $variants
     */
    public function withVariants(array $variants): self
    {
        $obj = clone $this;
        $obj->variants = $variants;

        return $obj;
    }

    /**
     * @param VideoCodec::* $videoCodec
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $obj = clone $this;
        $obj->videoCodec = $videoCodec;

        return $obj;
    }
}
