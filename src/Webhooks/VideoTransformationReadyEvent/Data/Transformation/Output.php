<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output\VideoMetadata;

/**
 * Information about the transformed output video.
 *
 * @phpstan-type OutputShape = array{
 *   url: string, video_metadata?: VideoMetadata|null
 * }
 */
final class Output implements BaseModel
{
    /** @use SdkModel<OutputShape> */
    use SdkModel;

    /**
     * URL to access the transformed video.
     */
    #[Api]
    public string $url;

    /**
     * Metadata of the output video file.
     */
    #[Api(optional: true)]
    public ?VideoMetadata $video_metadata;

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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $url,
        ?VideoMetadata $video_metadata = null
    ): self {
        $obj = new self;

        $obj->url = $url;

        null !== $video_metadata && $obj->video_metadata = $video_metadata;

        return $obj;
    }

    /**
     * URL to access the transformed video.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Metadata of the output video file.
     */
    public function withVideoMetadata(VideoMetadata $videoMetadata): self
    {
        $obj = clone $this;
        $obj->video_metadata = $videoMetadata;

        return $obj;
    }
}
