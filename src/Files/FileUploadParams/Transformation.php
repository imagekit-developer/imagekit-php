<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\FileUploadParams\Transformation\Post;
use Imagekit\Files\FileUploadParams\Transformation\Post\Abs;
use Imagekit\Files\FileUploadParams\Transformation\Post\Abs\Protocol;
use Imagekit\Files\FileUploadParams\Transformation\Post\GifToVideo;
use Imagekit\Files\FileUploadParams\Transformation\Post\Thumbnail;

/**
 * Configure pre-processing (`pre`) and post-processing (`post`) transformations.
 *
 * - `pre` — applied before the file is uploaded to the Media Library.
 *   Useful for reducing file size or applying basic optimizations upfront (e.g., resize, compress).
 *
 * - `post` — applied immediately after upload.
 *   Ideal for generating transformed versions (like video encodes or thumbnails) in advance, so they're ready for delivery without delay.
 *
 * You can mix and match any combination of post-processing types.
 *
 * @phpstan-type TransformationShape = array{
 *   post?: list<\Imagekit\Files\FileUploadParams\Transformation\Post\Transformation|GifToVideo|Thumbnail|Abs>|null,
 *   pre?: string|null,
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @var list<Post\Transformation|GifToVideo|Thumbnail|Abs>|null $post
     */
    #[Optional(list: Post::class)]
    public ?array $post;

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    #[Optional]
    public ?string $pre;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Post\Transformation|array{
     *   type: 'transformation', value: string
     * }|GifToVideo|array{type: 'gif-to-video', value?: string|null}|Thumbnail|array{
     *   type: 'thumbnail', value?: string|null
     * }|Abs|array{protocol: value-of<Protocol>, type: 'abs', value: string}> $post
     */
    public static function with(?array $post = null, ?string $pre = null): self
    {
        $obj = new self;

        null !== $post && $obj['post'] = $post;
        null !== $pre && $obj['pre'] = $pre;

        return $obj;
    }

    /**
     * List of transformations to apply *after* the file is uploaded.
     * Each item must match one of the following types:
     * `transformation`, `gif-to-video`, `thumbnail`, `abs`.
     *
     * @param list<Post\Transformation|array{
     *   type: 'transformation', value: string
     * }|GifToVideo|array{type: 'gif-to-video', value?: string|null}|Thumbnail|array{
     *   type: 'thumbnail', value?: string|null
     * }|Abs|array{protocol: value-of<Protocol>, type: 'abs', value: string}> $post
     */
    public function withPost(array $post): self
    {
        $obj = clone $this;
        $obj['post'] = $post;

        return $obj;
    }

    /**
     * Transformation string to apply before uploading the file to the Media Library. Useful for optimizing files at ingestion.
     */
    public function withPre(string $pre): self
    {
        $obj = clone $this;
        $obj['pre'] = $pre;

        return $obj;
    }
}
