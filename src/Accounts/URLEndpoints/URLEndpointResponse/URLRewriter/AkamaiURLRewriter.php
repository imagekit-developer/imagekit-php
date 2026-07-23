<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

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
