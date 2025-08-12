<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * Object containing GPS information.
 *
 * @phpstan-type gps_alias = array{gpsVersionID?: list<int>}
 */
final class Gps implements BaseModel
{
    use Model;

    /** @var null|list<int> $gpsVersionID */
    #[Api('GPSVersionID', type: new ListOf('int'), optional: true)]
    public ?array $gpsVersionID;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<int> $gpsVersionID
     */
    public static function from(?array $gpsVersionID = null): self
    {
        $obj = new self;

        null !== $gpsVersionID && $obj->gpsVersionID = $gpsVersionID;

        return $obj;
    }

    /**
     * @param list<int> $gpsVersionID
     */
    public function setGpsVersionID(array $gpsVersionID): self
    {
        $this->gpsVersionID = $gpsVersionID;

        return $this;
    }
}
