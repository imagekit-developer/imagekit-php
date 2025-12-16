<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type OverlayPositionShape from \Imagekit\OverlayPosition
 * @phpstan-import-type OverlayTimingShape from \Imagekit\OverlayTiming
 *
 * @phpstan-type BaseOverlayShape = array{
 *   position?: null|OverlayPosition|OverlayPositionShape,
 *   timing?: null|OverlayTiming|OverlayTimingShape,
 * }
 */
final class BaseOverlay implements BaseModel
{
    /** @use SdkModel<BaseOverlayShape> */
    use SdkModel;

    #[Optional]
    public ?OverlayPosition $position;

    #[Optional]
    public ?OverlayTiming $timing;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param OverlayPositionShape $position
     * @param OverlayTimingShape $timing
     */
    public static function with(
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null
    ): self {
        $self = new self;

        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;

        return $self;
    }

    /**
     * @param OverlayPositionShape $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * @param OverlayTimingShape $timing
     */
    public function withTiming(OverlayTiming|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }
}
