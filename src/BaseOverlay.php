<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\OverlayPosition\Focus;

/**
 * @phpstan-type BaseOverlayShape = array{
 *   position?: OverlayPosition|null, timing?: OverlayTiming|null
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
     * @param OverlayPosition|array{
     *   focus?: value-of<Focus>|null, x?: float|string|null, y?: float|string|null
     * } $position
     * @param OverlayTiming|array{
     *   duration?: float|string|null,
     *   end?: float|string|null,
     *   start?: float|string|null,
     * } $timing
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
     * @param OverlayPosition|array{
     *   focus?: value-of<Focus>|null, x?: float|string|null, y?: float|string|null
     * } $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * @param OverlayTiming|array{
     *   duration?: float|string|null,
     *   end?: float|string|null,
     *   start?: float|string|null,
     * } $timing
     */
    public function withTiming(OverlayTiming|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }
}
