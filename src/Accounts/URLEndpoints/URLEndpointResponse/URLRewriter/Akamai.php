<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AkamaiShape = array{type: 'AKAMAI'}
 */
final class Akamai implements BaseModel
{
    /** @use SdkModel<AkamaiShape> */
    use SdkModel;

    /** @var 'AKAMAI' $type */
    #[Api]
    public string $type = 'AKAMAI';

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
