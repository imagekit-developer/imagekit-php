<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type timings_alias = array{
 *   downloadDuration?: int, encodingDuration?: int
 * }
 */
final class Timings implements BaseModel
{
    use SdkModel;

    /**
     * Milliseconds spent downloading the source.
     */
    #[Api('download_duration', optional: true)]
    public ?int $downloadDuration;

    /**
     * Milliseconds spent encoding.
     */
    #[Api('encoding_duration', optional: true)]
    public ?int $encodingDuration;

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
        ?int $downloadDuration = null,
        ?int $encodingDuration = null
    ): self {
        $obj = new self;

        null !== $downloadDuration && $obj->downloadDuration = $downloadDuration;
        null !== $encodingDuration && $obj->encodingDuration = $encodingDuration;

        return $obj;
    }

    /**
     * Milliseconds spent downloading the source.
     */
    public function withDownloadDuration(int $downloadDuration): self
    {
        $obj = clone $this;
        $obj->downloadDuration = $downloadDuration;

        return $obj;
    }

    /**
     * Milliseconds spent encoding.
     */
    public function withEncodingDuration(int $encodingDuration): self
    {
        $obj = clone $this;
        $obj->encodingDuration = $encodingDuration;

        return $obj;
    }
}
