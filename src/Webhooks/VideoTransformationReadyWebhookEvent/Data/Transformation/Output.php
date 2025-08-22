<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation\Output\VideoMetadata;

/**
 * @phpstan-type output_alias = array{url: string, videoMetadata?: VideoMetadata}
 */
final class Output implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $url;

    #[Api('video_metadata', optional: true)]
    public ?VideoMetadata $videoMetadata;

    /**
     * `new Output()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Output::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Output)->withURL(...)
     * ```
     */
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
        string $url,
        ?VideoMetadata $videoMetadata = null
    ): self {
        $obj = new self;

        $obj->url = $url;

        null !== $videoMetadata && $obj->videoMetadata = $videoMetadata;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    public function withVideoMetadata(VideoMetadata $videoMetadata): self
    {
        $obj = clone $this;
        $obj->videoMetadata = $videoMetadata;

        return $obj;
    }
}
