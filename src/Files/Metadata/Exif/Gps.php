<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing GPS information.
 *
 * @phpstan-type GpsShape = array{gpsVersionID?: list<int>}
 */
final class Gps implements BaseModel
{
    /** @use SdkModel<GpsShape> */
    use SdkModel;

    /** @var list<int>|null $gpsVersionID */
    #[Api('GPSVersionID', list: 'int', optional: true)]
    public ?array $gpsVersionID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int> $gpsVersionID
     */
    public static function with(?array $gpsVersionID = null): self
    {
        $obj = new self;

        null !== $gpsVersionID && $obj->gpsVersionID = $gpsVersionID;

        return $obj;
    }

    /**
     * @param list<int> $gpsVersionID
     */
    public function withGpsVersionID(array $gpsVersionID): self
    {
        $obj = clone $this;
        $obj->gpsVersionID = $gpsVersionID;

        return $obj;
    }
}
