<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileMoveResponseShape = array<string,mixed>
 */
final class FileMoveResponse implements BaseModel
{
    /** @use SdkModel<FileMoveResponseShape> */
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
