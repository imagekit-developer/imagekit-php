<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing GPS information.
 *
 * @phpstan-type GpsShape = array{
 *   gpsAltitude?: float|null,
 *   gpsAltitudeRef?: int|null,
 *   gpsDateStamp?: string|null,
 *   gpsImgDirection?: float|null,
 *   gpsImgDirectionRef?: string|null,
 *   gpsLatitude?: list<float>|null,
 *   gpsLatitudeRef?: string|null,
 *   gpsLongitude?: list<float>|null,
 *   gpsLongitudeRef?: string|null,
 *   gpsTimeStamp?: list<float>|null,
 *   gpsVersionID?: list<int>|null,
 * }
 */
final class Gps implements BaseModel
{
    /** @use SdkModel<GpsShape> */
    use SdkModel;

    #[Optional('GPSAltitude')]
    public ?float $gpsAltitude;

    #[Optional('GPSAltitudeRef')]
    public ?int $gpsAltitudeRef;

    #[Optional('GPSDateStamp')]
    public ?string $gpsDateStamp;

    #[Optional('GPSImgDirection')]
    public ?float $gpsImgDirection;

    #[Optional('GPSImgDirectionRef')]
    public ?string $gpsImgDirectionRef;

    /** @var list<float>|null $gpsLatitude */
    #[Optional('GPSLatitude', list: 'float')]
    public ?array $gpsLatitude;

    #[Optional('GPSLatitudeRef')]
    public ?string $gpsLatitudeRef;

    /** @var list<float>|null $gpsLongitude */
    #[Optional('GPSLongitude', list: 'float')]
    public ?array $gpsLongitude;

    #[Optional('GPSLongitudeRef')]
    public ?string $gpsLongitudeRef;

    /** @var list<float>|null $gpsTimeStamp */
    #[Optional('GPSTimeStamp', list: 'float')]
    public ?array $gpsTimeStamp;

    /** @var list<int>|null $gpsVersionID */
    #[Optional('GPSVersionID', list: 'int')]
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
     * @param list<float>|null $gpsLatitude
     * @param list<float>|null $gpsLongitude
     * @param list<float>|null $gpsTimeStamp
     * @param list<int>|null $gpsVersionID
     */
    public static function with(
        ?float $gpsAltitude = null,
        ?int $gpsAltitudeRef = null,
        ?string $gpsDateStamp = null,
        ?float $gpsImgDirection = null,
        ?string $gpsImgDirectionRef = null,
        ?array $gpsLatitude = null,
        ?string $gpsLatitudeRef = null,
        ?array $gpsLongitude = null,
        ?string $gpsLongitudeRef = null,
        ?array $gpsTimeStamp = null,
        ?array $gpsVersionID = null,
    ): self {
        $self = new self;

        null !== $gpsAltitude && $self['gpsAltitude'] = $gpsAltitude;
        null !== $gpsAltitudeRef && $self['gpsAltitudeRef'] = $gpsAltitudeRef;
        null !== $gpsDateStamp && $self['gpsDateStamp'] = $gpsDateStamp;
        null !== $gpsImgDirection && $self['gpsImgDirection'] = $gpsImgDirection;
        null !== $gpsImgDirectionRef && $self['gpsImgDirectionRef'] = $gpsImgDirectionRef;
        null !== $gpsLatitude && $self['gpsLatitude'] = $gpsLatitude;
        null !== $gpsLatitudeRef && $self['gpsLatitudeRef'] = $gpsLatitudeRef;
        null !== $gpsLongitude && $self['gpsLongitude'] = $gpsLongitude;
        null !== $gpsLongitudeRef && $self['gpsLongitudeRef'] = $gpsLongitudeRef;
        null !== $gpsTimeStamp && $self['gpsTimeStamp'] = $gpsTimeStamp;
        null !== $gpsVersionID && $self['gpsVersionID'] = $gpsVersionID;

        return $self;
    }

    public function withGpsAltitude(float $gpsAltitude): self
    {
        $self = clone $this;
        $self['gpsAltitude'] = $gpsAltitude;

        return $self;
    }

    public function withGpsAltitudeRef(int $gpsAltitudeRef): self
    {
        $self = clone $this;
        $self['gpsAltitudeRef'] = $gpsAltitudeRef;

        return $self;
    }

    public function withGpsDateStamp(string $gpsDateStamp): self
    {
        $self = clone $this;
        $self['gpsDateStamp'] = $gpsDateStamp;

        return $self;
    }

    public function withGpsImgDirection(float $gpsImgDirection): self
    {
        $self = clone $this;
        $self['gpsImgDirection'] = $gpsImgDirection;

        return $self;
    }

    public function withGpsImgDirectionRef(string $gpsImgDirectionRef): self
    {
        $self = clone $this;
        $self['gpsImgDirectionRef'] = $gpsImgDirectionRef;

        return $self;
    }

    /**
     * @param list<float> $gpsLatitude
     */
    public function withGpsLatitude(array $gpsLatitude): self
    {
        $self = clone $this;
        $self['gpsLatitude'] = $gpsLatitude;

        return $self;
    }

    public function withGpsLatitudeRef(string $gpsLatitudeRef): self
    {
        $self = clone $this;
        $self['gpsLatitudeRef'] = $gpsLatitudeRef;

        return $self;
    }

    /**
     * @param list<float> $gpsLongitude
     */
    public function withGpsLongitude(array $gpsLongitude): self
    {
        $self = clone $this;
        $self['gpsLongitude'] = $gpsLongitude;

        return $self;
    }

    public function withGpsLongitudeRef(string $gpsLongitudeRef): self
    {
        $self = clone $this;
        $self['gpsLongitudeRef'] = $gpsLongitudeRef;

        return $self;
    }

    /**
     * @param list<float> $gpsTimeStamp
     */
    public function withGpsTimeStamp(array $gpsTimeStamp): self
    {
        $self = clone $this;
        $self['gpsTimeStamp'] = $gpsTimeStamp;

        return $self;
    }

    /**
     * @param list<int> $gpsVersionID
     */
    public function withGpsVersionID(array $gpsVersionID): self
    {
        $self = clone $this;
        $self['gpsVersionID'] = $gpsVersionID;

        return $self;
    }
}
