<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Performance metrics for the transformation process.
 *
 * @phpstan-type TimingsShape = array{
 *   download_duration?: int|null, encoding_duration?: int|null
 * }
 */
final class Timings implements BaseModel
{
    /** @use SdkModel<TimingsShape> */
    use SdkModel;

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    #[Optional]
    public ?int $download_duration;

    /**
     * Time spent encoding the video, in milliseconds.
     */
    #[Optional]
    public ?int $encoding_duration;

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
        ?int $download_duration = null,
        ?int $encoding_duration = null
    ): self {
        $obj = new self;

        null !== $download_duration && $obj['download_duration'] = $download_duration;
        null !== $encoding_duration && $obj['encoding_duration'] = $encoding_duration;

        return $obj;
    }

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    public function withDownloadDuration(int $downloadDuration): self
    {
        $obj = clone $this;
        $obj['download_duration'] = $downloadDuration;

        return $obj;
    }

    /**
     * Time spent encoding the video, in milliseconds.
     */
    public function withEncodingDuration(int $encodingDuration): self
    {
        $obj = clone $this;
        $obj['encoding_duration'] = $encodingDuration;

        return $obj;
    }
}
