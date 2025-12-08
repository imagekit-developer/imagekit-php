<?php

declare(strict_types=1);

namespace Imagekit\Files\Versions;

use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type VersionDeleteResponseShape = array<string,mixed>
 */
final class VersionDeleteResponse implements BaseModel
{
    /** @use SdkModel<VersionDeleteResponseShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
