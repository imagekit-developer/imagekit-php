<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output\VideoMetadata;

/**
 * Information about the transformed output video.
 *
 * @phpstan-type OutputShape = array{
 *   url: string, videoMetadata?: VideoMetadata|null
 * }
 */
final class Output implements BaseModel
{
    /** @use SdkModel<OutputShape> */
    use SdkModel;

    /**
     * URL to access the transformed video.
     */
    #[Required]
    public string $url;

    /**
     * Metadata of the output video file.
     */
    #[Optional('video_metadata')]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param VideoMetadata|array{
     *   bitrate: int, duration: float, height: int, width: int
     * } $videoMetadata
     */
    public static function with(
        string $url,
        VideoMetadata|array|null $videoMetadata = null
    ): self {
        $obj = new self;

        $obj['url'] = $url;

        null !== $videoMetadata && $obj['videoMetadata'] = $videoMetadata;

        return $obj;
    }

    /**
     * URL to access the transformed video.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * Metadata of the output video file.
     *
     * @param VideoMetadata|array{
     *   bitrate: int, duration: float, height: int, width: int
     * } $videoMetadata
     */
    public function withVideoMetadata(VideoMetadata|array $videoMetadata): self
    {
        $obj = clone $this;
        $obj['videoMetadata'] = $videoMetadata;

        return $obj;
    }
}
