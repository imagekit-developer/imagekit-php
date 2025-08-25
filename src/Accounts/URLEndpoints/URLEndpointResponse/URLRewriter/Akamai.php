<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

final class Akamai implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $type = 'AKAMAI';

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
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
