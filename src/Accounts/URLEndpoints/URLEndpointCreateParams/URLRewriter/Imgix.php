<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ImgixShape = array{type: "IMGIX"}
 */
final class Imgix implements BaseModel
{
    /** @use SdkModel<ImgixShape> */
    use SdkModel;

    /** @var "IMGIX" $type */
    #[Api]
    public string $type = 'IMGIX';

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
