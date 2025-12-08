<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Object containing GPS information.
 *
 * @phpstan-type GpsShape = array{GPSVersionID?: list<int>|null}
 */
final class Gps implements BaseModel
{
    /** @use SdkModel<GpsShape> */
    use SdkModel;

    /** @var list<int>|null $GPSVersionID */
    #[Optional(list: 'int')]
    public ?array $GPSVersionID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int> $GPSVersionID
     */
    public static function with(?array $GPSVersionID = null): self
    {
        $obj = new self;

        null !== $GPSVersionID && $obj['GPSVersionID'] = $GPSVersionID;

        return $obj;
    }

    /**
     * @param list<int> $gpsVersionID
     */
    public function withGpsVersionID(array $gpsVersionID): self
    {
        $obj = clone $this;
        $obj['GPSVersionID'] = $gpsVersionID;

        return $obj;
    }
}
