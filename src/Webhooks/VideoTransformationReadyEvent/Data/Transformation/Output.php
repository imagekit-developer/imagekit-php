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
 * @phpstan-import-type VideoMetadataShape from \Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output\VideoMetadata
 *
 * @phpstan-type OutputShape = array{
 *   url: string, videoMetadata?: null|VideoMetadata|VideoMetadataShape
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
     * @param VideoMetadataShape $videoMetadata
     */
    public static function with(
        string $url,
        VideoMetadata|array|null $videoMetadata = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $videoMetadata && $self['videoMetadata'] = $videoMetadata;

        return $self;
    }

    /**
     * URL to access the transformed video.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Metadata of the output video file.
     *
     * @param VideoMetadataShape $videoMetadata
     */
    public function withVideoMetadata(VideoMetadata|array $videoMetadata): self
    {
        $self = clone $this;
        $self['videoMetadata'] = $videoMetadata;

        return $self;
    }
}
