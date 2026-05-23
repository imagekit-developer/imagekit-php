<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ImgixURLRewriterShape = array{type: 'IMGIX'}
 */
final class ImgixURLRewriter implements BaseModel
{
    /** @use SdkModel<ImgixURLRewriterShape> */
    use SdkModel;

    /** @var 'IMGIX' $type */
    #[Required]
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

    /**
     * @param 'IMGIX' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
