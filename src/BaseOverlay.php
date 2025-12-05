<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\OverlayPosition\Focus;

/**
 * @phpstan-type BaseOverlayShape = array{
 *   position?: OverlayPosition|null, timing?: OverlayTiming|null
 * }
 */
final class BaseOverlay implements BaseModel
{
    /** @use SdkModel<BaseOverlayShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?OverlayPosition $position;

    #[Api(optional: true)]
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
        $obj = new self;

        null !== $position && $obj['position'] = $position;
        null !== $timing && $obj['timing'] = $timing;

        return $obj;
    }

    /**
     * @param OverlayPosition|array{
     *   focus?: value-of<Focus>|null, x?: float|string|null, y?: float|string|null
     * } $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $obj = clone $this;
        $obj['position'] = $position;

        return $obj;
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
        $obj = clone $this;
        $obj['timing'] = $timing;

        return $obj;
    }
}
