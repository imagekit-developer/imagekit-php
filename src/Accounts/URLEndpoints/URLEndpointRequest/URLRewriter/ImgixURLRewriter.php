<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

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
}
