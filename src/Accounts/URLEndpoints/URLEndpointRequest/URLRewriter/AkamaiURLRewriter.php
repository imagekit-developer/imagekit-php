<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AkamaiURLRewriterShape = array{type: 'AKAMAI'}
 */
final class AkamaiURLRewriter implements BaseModel
{
    /** @use SdkModel<AkamaiURLRewriterShape> */
    use SdkModel;

    /** @var 'AKAMAI' $type */
    #[Required]
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

    /**
     * @param 'AKAMAI' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
