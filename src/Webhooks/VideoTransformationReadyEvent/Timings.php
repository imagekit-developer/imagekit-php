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
 *   downloadDuration?: int|null, encodingDuration?: int|null
 * }
 */
final class Timings implements BaseModel
{
    /** @use SdkModel<TimingsShape> */
    use SdkModel;

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    #[Optional('download_duration')]
    public ?int $downloadDuration;

    /**
     * Time spent encoding the video, in milliseconds.
     */
    #[Optional('encoding_duration')]
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
        $self = new self;

        null !== $downloadDuration && $self['downloadDuration'] = $downloadDuration;
        null !== $encodingDuration && $self['encodingDuration'] = $encodingDuration;

        return $self;
    }

    /**
     * Time spent downloading the source video from your origin or media library, in milliseconds.
     */
    public function withDownloadDuration(int $downloadDuration): self
    {
        $self = clone $this;
        $self['downloadDuration'] = $downloadDuration;

        return $self;
    }

    /**
     * Time spent encoding the video, in milliseconds.
     */
    public function withEncodingDuration(int $encodingDuration): self
    {
        $self = clone $this;
        $self['encodingDuration'] = $encodingDuration;

        return $self;
    }
}
