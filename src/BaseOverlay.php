<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BaseOverlayShape = array{
 *   position?: OverlayPosition, timing?: OverlayTiming
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
     */
    public static function with(
        ?OverlayPosition $position = null,
        ?OverlayTiming $timing = null
    ): self {
        $obj = new self;

        null !== $position && $obj->position = $position;
        null !== $timing && $obj->timing = $timing;

        return $obj;
    }

    public function withPosition(OverlayPosition $position): self
    {
        $obj = clone $this;
        $obj->position = $position;

        return $obj;
    }

    public function withTiming(OverlayTiming $timing): self
    {
        $obj = clone $this;
        $obj->timing = $timing;

        return $obj;
    }
}
