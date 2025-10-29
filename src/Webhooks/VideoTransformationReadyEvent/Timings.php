<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Performance metrics for the transformation process.
 *
 * @phpstan-type TimingsShape = array{
 *   downloadDuration?: int, encodingDuration?: int
 * }
 */
final class Timings implements BaseModel
{
    /** @use SdkModel<TimingsShape> */
    use SdkModel;

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    #[Api('download_duration', optional: true)]
    public ?int $downloadDuration;

    /**
     * Time spent encoding the video, in milliseconds.
     */
    #[Api('encoding_duration', optional: true)]
    public ?int $encodingDuration;

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
        ?int $downloadDuration = null,
        ?int $encodingDuration = null
    ): self {
        $obj = new self;

        null !== $downloadDuration && $obj->downloadDuration = $downloadDuration;
        null !== $encodingDuration && $obj->encodingDuration = $encodingDuration;

        return $obj;
    }

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    public function withDownloadDuration(int $downloadDuration): self
    {
        $obj = clone $this;
        $obj->downloadDuration = $downloadDuration;

        return $obj;
    }

    /**
     * Time spent encoding the video, in milliseconds.
     */
    public function withEncodingDuration(int $encodingDuration): self
    {
        $obj = clone $this;
        $obj->encodingDuration = $encodingDuration;

        return $obj;
    }
}
