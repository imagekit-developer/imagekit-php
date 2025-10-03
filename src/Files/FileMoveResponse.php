<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkResponse;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type file_move_response = array{}
 */
final class FileMoveResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<file_move_response> */
    use SdkModel;

    use SdkResponse;

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
