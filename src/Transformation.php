<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Transformation\AudioCodec;
use Imagekit\Transformation\Crop;
use Imagekit\Transformation\CropMode;
use Imagekit\Transformation\Flip;
use Imagekit\Transformation\Format;
use Imagekit\Transformation\VideoCodec;

/**
 * The SDK provides easy-to-use names for transformations. These names are converted to the corresponding transformation string before being added to the URL.
 * SDKs are updated regularly to support new transformations. If you want to use a transformation that is not supported by the SDK,
 * You can use the `raw` parameter to pass the transformation string directly.
 * See the [Transformations documentation](https://imagekit.io/docs/transformations).
 *
 * @phpstan-type TransformationShape = array{
 *   aiChangeBackground?: string|null,
 *   aiDropShadow?: string|null|bool,
 *   aiEdit?: string|null,
 *   aiRemoveBackground?: bool|null,
 *   aiRemoveBackgroundExternal?: bool|null,
 *   aiRetouch?: bool|null,
 *   aiUpscale?: bool|null,
 *   aiVariation?: bool|null,
 *   aspectRatio?: float|string|null,
 *   audioCodec?: value-of<AudioCodec>|null,
 *   background?: string|null,
 *   blur?: float|null,
 *   border?: string|null,
 *   colorProfile?: bool|null,
 *   contrastStretch?: bool|null,
 *   crop?: value-of<Crop>|null,
 *   cropMode?: value-of<CropMode>|null,
 *   defaultImage?: string|null,
 *   dpr?: float|null,
 *   duration?: float|string|null,
 *   endOffset?: float|string|null,
 *   flip?: value-of<Flip>|null,
 *   focus?: string|null,
 *   format?: value-of<Format>|null,
 *   gradient?: string|null|bool,
 *   grayscale?: bool|null,
 *   height?: float|string|null,
 *   lossless?: bool|null,
 *   metadata?: bool|null,
 *   named?: string|null,
 *   opacity?: float|null,
 *   original?: bool|null,
 *   overlay?: Overlay|null,
 *   page?: float|string|null,
 *   progressive?: bool|null,
 *   quality?: float|null,
 *   radius?: float|null|'max',
 *   raw?: string|null,
 *   rotation?: float|string|null,
 *   shadow?: string|null|bool,
 *   sharpen?: float|null|bool,
 *   startOffset?: float|string|null,
 *   streamingResolutions?: list<value-of<StreamingResolution>>|null,
 *   trim?: float|null|bool,
 *   unsharpMask?: string|null|bool,
 *   videoCodec?: value-of<VideoCodec>|null,
 *   width?: float|string|null,
 *   x?: float|string|null,
 *   xCenter?: float|string|null,
 *   y?: float|string|null,
 *   yCenter?: float|string|null,
 *   zoom?: float|null,
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    /**
     * Uses AI to change the background. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Change Background](https://imagekit.io/docs/ai-transformations#change-background-e-changebg).
     */
    #[Optional]
    public ?string $aiChangeBackground;

    /**
     * Adds an AI-based drop shadow around a foreground object on a transparent or removed background.
     * Optionally, control the direction, elevation, and saturation of the light source (e.g., `az-45` to change light direction).
     * Pass `true` for the default drop shadow, or provide a string for a custom drop shadow.
     * Supported inside overlay.
     * See [AI Drop Shadow](https://imagekit.io/docs/ai-transformations#ai-drop-shadow-e-dropshadow).
     */
    #[Optional]
    public string|bool|null $aiDropShadow;

    /**
     * Uses AI to edit images based on a text prompt. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Edit](https://imagekit.io/docs/ai-transformations#edit-image-e-edit).
     */
    #[Optional]
    public ?string $aiEdit;

    /**
     * Applies ImageKit's in-house background removal.
     * Supported inside overlay.
     * See [AI Background Removal](https://imagekit.io/docs/ai-transformations#imagekit-background-removal-e-bgremove).
     */
    #[Optional]
    public ?bool $aiRemoveBackground;

    /**
     * Uses third-party background removal.
     * Note: It is recommended to use aiRemoveBackground, ImageKit's in-house solution, which is more cost-effective.
     * Supported inside overlay.
     * See [External Background Removal](https://imagekit.io/docs/ai-transformations#background-removal-e-removedotbg).
     */
    #[Optional]
    public ?bool $aiRemoveBackgroundExternal;

    /**
     * Performs AI-based retouching to improve faces or product shots. Not supported inside overlay.
     * See [AI Retouch](https://imagekit.io/docs/ai-transformations#retouch-e-retouch).
     */
    #[Optional]
    public ?bool $aiRetouch;

    /**
     * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
     * See [AI Upscale](https://imagekit.io/docs/ai-transformations#upscale-e-upscale).
     */
    #[Optional]
    public ?bool $aiUpscale;

    /**
     * Generates a variation of an image using AI. This produces a new image with slight variations from the original,
     * such as changes in color, texture, and other visual elements, while preserving the structure and essence of the original image. Not supported inside overlay.
     * See [AI Generate Variations](https://imagekit.io/docs/ai-transformations#generate-variations-of-an-image-e-genvar).
     */
    #[Optional]
    public ?bool $aiVariation;

    /**
     * Specifies the aspect ratio for the output, e.g., "ar-4-3". Typically used with either width or height (but not both).
     * For example: aspectRatio = `4:3`, `4_3`, or an expression like `iar_div_2`.
     * See [Image resize and crop – Aspect ratio](https://imagekit.io/docs/image-resize-and-crop#aspect-ratio---ar).
     */
    #[Optional]
    public float|string|null $aspectRatio;

    /**
     * Specifies the audio codec, e.g., `aac`, `opus`, or `none`. See [Audio codec](https://imagekit.io/docs/video-optimization#audio-codec---ac).
     *
     * @var value-of<AudioCodec>|null $audioCodec
     */
    #[Optional(enum: AudioCodec::class)]
    public ?string $audioCodec;

    /**
     * Specifies the background to be used in conjunction with certain cropping strategies when resizing an image.
     * - A solid color: e.g., `red`, `F3F3F3`, `AAFF0010`. See [Solid color background](https://imagekit.io/docs/effects-and-enhancements#solid-color-background).
     * - A blurred background: e.g., `blurred`, `blurred_25_N15`, etc. See [Blurred background](https://imagekit.io/docs/effects-and-enhancements#blurred-background).
     * - Expand the image boundaries using generative fill: `genfill`. Not supported inside overlay. Optionally, control the background scene by passing a text prompt:
     *   `genfill[:-prompt-${text}]` or `genfill[:-prompte-${urlencoded_base64_encoded_text}]`. See [Generative fill background](https://imagekit.io/docs/ai-transformations#generative-fill-bg-genfill).
     */
    #[Optional]
    public ?string $background;

    /**
     * Specifies the Gaussian blur level. Accepts an integer value between 1 and 100, or an expression like `bl-10`.
     * See [Blur](https://imagekit.io/docs/effects-and-enhancements#blur---bl).
     */
    #[Optional]
    public ?float $blur;

    /**
     * Adds a border to the output media. Accepts a string in the format `<border-width>_<hex-code>`
     * (e.g., `5_FFF000` for a 5px yellow border), or an expression like `ih_div_20_FF00FF`.
     * See [Border](https://imagekit.io/docs/effects-and-enhancements#border---b).
     */
    #[Optional]
    public ?string $border;

    /**
     * Indicates whether the output image should retain the original color profile.
     * See [Color profile](https://imagekit.io/docs/image-optimization#color-profile---cp).
     */
    #[Optional]
    public ?bool $colorProfile;

    /**
     * Automatically enhances the contrast of an image (contrast stretch).
     * See [Contrast Stretch](https://imagekit.io/docs/effects-and-enhancements#contrast-stretch---e-contrast).
     */
    #[Optional]
    public ?bool $contrastStretch;

    /**
     * Crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @var value-of<Crop>|null $crop
     */
    #[Optional(enum: Crop::class)]
    public ?string $crop;

    /**
     * Additional crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @var value-of<CropMode>|null $cropMode
     */
    #[Optional(enum: CropMode::class)]
    public ?string $cropMode;

    /**
     * Specifies a fallback image if the resource is not found, e.g., a URL or file path.
     * See [Default image](https://imagekit.io/docs/image-transformation#default-image---di).
     */
    #[Optional]
    public ?string $defaultImage;

    /**
     * Accepts values between 0.1 and 5, or `auto` for automatic device pixel ratio (DPR) calculation.
     * See [DPR](https://imagekit.io/docs/image-resize-and-crop#dpr---dpr).
     */
    #[Optional]
    public ?float $dpr;

    /**
     * Specifies the duration (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to indicate the length from the start offset. Arithmetic expressions are supported.
     * See [Trim videos – Duration](https://imagekit.io/docs/trim-videos#duration---du).
     */
    #[Optional]
    public float|string|null $duration;

    /**
     * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
     * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
     */
    #[Optional]
    public float|string|null $endOffset;

    /**
     * Flips or mirrors an image either horizontally, vertically, or both.
     * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
     * See [Flip](https://imagekit.io/docs/effects-and-enhancements#flip---fl).
     *
     * @var value-of<Flip>|null $flip
     */
    #[Optional(enum: Flip::class)]
    public ?string $flip;

    /**
     * Refines padding and cropping behavior for pad resize, maintain ratio, and extract crop modes.
     * Supports manual positions and coordinate-based focus. With AI-based cropping, you can automatically
     * keep key subjects in frame—such as faces or detected objects (e.g., `fo-face`, `fo-person`, `fo-car`)—
     * while resizing.
     * - See [Focus](https://imagekit.io/docs/image-resize-and-crop#focus---fo).
     * - [Object aware cropping](https://imagekit.io/docs/image-resize-and-crop#object-aware-cropping---fo-object-name).
     */
    #[Optional]
    public ?string $focus;

    /**
     * Specifies the output format for images or videos, e.g., `jpg`, `png`, `webp`, `mp4`, or `auto`.
     * You can also pass `orig` for images to return the original format.
     * ImageKit automatically delivers images and videos in the optimal format based on device support unless overridden by the dashboard settings or the format parameter.
     * See [Image format](https://imagekit.io/docs/image-optimization#format---f) and [Video format](https://imagekit.io/docs/video-optimization#format---f).
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    #[Optional]
    public string|bool|null $gradient;

    /**
     * Enables a grayscale effect for images. See [Grayscale](https://imagekit.io/docs/effects-and-enhancements#grayscale---e-grayscale).
     */
    #[Optional]
    public ?bool $grayscale;

    /**
     * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
     * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
     * Height transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#height---h) · [Videos](https://imagekit.io/docs/video-resize-and-crop#height---h).
     */
    #[Optional]
    public float|string|null $height;

    /**
     * Specifies whether the output image (in JPEG or PNG) should be compressed losslessly.
     * See [Lossless compression](https://imagekit.io/docs/image-optimization#lossless-webp-and-png---lo).
     */
    #[Optional]
    public ?bool $lossless;

    /**
     * By default, ImageKit removes all metadata during automatic image compression.
     * Set this to true to preserve metadata.
     * See [Image metadata](https://imagekit.io/docs/image-optimization#image-metadata---md).
     */
    #[Optional]
    public ?bool $metadata;

    /**
     * Named transformation reference. See [Named transformations](https://imagekit.io/docs/transformations#named-transformations).
     */
    #[Optional]
    public ?string $named;

    /**
     * Specifies the opacity level of the output image. See [Opacity](https://imagekit.io/docs/effects-and-enhancements#opacity---o).
     */
    #[Optional]
    public ?float $opacity;

    /**
     * If set to true, serves the original file without applying any transformations.
     * See [Deliver original file as-is](https://imagekit.io/docs/core-delivery-features#deliver-original-file-as-is---orig-true).
     */
    #[Optional]
    public ?bool $original;

    /**
     * Specifies an overlay to be applied on the parent image or video.
     * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
     * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
     */
    #[Optional(union: Overlay::class)]
    public ?Overlay $overlay;

    /**
     * Extracts a specific page or frame from multi-page or layered files (PDF, PSD, AI).
     * For example, specify by number (e.g., `2`), a range (e.g., `3-4` for the 2nd and 3rd layers),
     * or by name (e.g., `name-layer-4` for a PSD layer).
     * See [Thumbnail extraction](https://imagekit.io/docs/vector-and-animated-images#get-thumbnail-from-psd-pdf-ai-eps-and-animated-files).
     */
    #[Optional]
    public float|string|null $page;

    /**
     * Specifies whether the output JPEG image should be rendered progressively. Progressive loading begins with a low-quality,
     * pixelated version of the full image, which gradually improves to provide a faster perceived load time.
     * See [Progressive images](https://imagekit.io/docs/image-optimization#progressive-image---pr).
     */
    #[Optional]
    public ?bool $progressive;

    /**
     * Specifies the quality of the output image for lossy formats such as JPEG, WebP, and AVIF.
     * A higher quality value results in a larger file size with better quality, while a lower value produces a smaller file size with reduced quality.
     * See [Quality](https://imagekit.io/docs/image-optimization#quality---q).
     */
    #[Optional]
    public ?float $quality;

    /**
     * Specifies the corner radius for rounded corners (e.g., 20) or `max` for circular or oval shape.
     * See [Radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     *
     * @var float|'max'|null $radius
     */
    #[Optional]
    public float|string|null $radius;

    /**
     * Pass any transformation not directly supported by the SDK.
     * This transformation string is appended to the URL as provided.
     */
    #[Optional]
    public ?string $raw;

    /**
     * Specifies the rotation angle in degrees. Positive values rotate the image clockwise; you can also use, for example, `N40` for counterclockwise rotation
     * or `auto` to use the orientation specified in the image's EXIF data.
     * For videos, only the following values are supported: 0, 90, 180, 270, or 360.
     * See [Rotate](https://imagekit.io/docs/effects-and-enhancements#rotate---rt).
     */
    #[Optional]
    public float|string|null $rotation;

    /**
     * Adds a shadow beneath solid objects in an image with a transparent background.
     * For AI-based drop shadows, refer to aiDropShadow.
     * Pass `true` for a default shadow, or provide a string for a custom shadow.
     * See [Shadow](https://imagekit.io/docs/effects-and-enhancements#shadow---e-shadow).
     */
    #[Optional]
    public string|bool|null $shadow;

    /**
     * Sharpens the input image, highlighting edges and finer details.
     * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
     * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
     */
    #[Optional]
    public float|bool|null $sharpen;

    /**
     * Specifies the start offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Arithmetic expressions are also supported.
     * See [Trim videos – Start offset](https://imagekit.io/docs/trim-videos#start-offset---so).
     */
    #[Optional]
    public float|string|null $startOffset;

    /**
     * An array of resolutions for adaptive bitrate streaming, e.g., [`240`, `360`, `480`, `720`, `1080`].
     * See [Adaptive Bitrate Streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
     *
     * @var list<value-of<StreamingResolution>>|null $streamingResolutions
     */
    #[Optional(list: StreamingResolution::class)]
    public ?array $streamingResolutions;

    /**
     * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
     * leaving only the central object in the output image.
     * See [Trim edges](https://imagekit.io/docs/effects-and-enhancements#trim-edges---t).
     */
    #[Optional]
    public float|bool|null $trim;

    /**
     * Applies Unsharp Masking (USM), an image sharpening technique.
     * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
     * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
     */
    #[Optional]
    public string|bool|null $unsharpMask;

    /**
     * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`. See [Video codec](https://imagekit.io/docs/video-optimization#video-codec---vc).
     *
     * @var value-of<VideoCodec>|null $videoCodec
     */
    #[Optional(enum: VideoCodec::class)]
    public ?string $videoCodec;

    /**
     * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
     * You can also supply arithmetic expressions (e.g., `iw_div_2`).
     * Width transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#width---w) · [Videos](https://imagekit.io/docs/video-resize-and-crop#width---w).
     */
    #[Optional]
    public float|string|null $width;

    /**
     * Focus using cropped image coordinates - X coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Optional]
    public float|string|null $x;

    /**
     * Focus using cropped image coordinates - X center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Optional]
    public float|string|null $xCenter;

    /**
     * Focus using cropped image coordinates - Y coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Optional]
    public float|string|null $y;

    /**
     * Focus using cropped image coordinates - Y center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Optional]
    public float|string|null $yCenter;

    /**
     * Accepts a numeric value that determines how much to zoom in or out of the cropped area.
     * It should be used in conjunction with fo-face or fo-<object_name>.
     * See [Zoom](https://imagekit.io/docs/image-resize-and-crop#zoom---z).
     */
    #[Optional]
    public ?float $zoom;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudioCodec|value-of<AudioCodec> $audioCodec
     * @param Crop|value-of<Crop> $crop
     * @param CropMode|value-of<CropMode> $cropMode
     * @param Flip|value-of<Flip> $flip
     * @param Format|value-of<Format> $format
     * @param float|'max' $radius
     * @param list<StreamingResolution|value-of<StreamingResolution>> $streamingResolutions
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public static function with(
        ?string $aiChangeBackground = null,
        string|bool|null $aiDropShadow = null,
        ?string $aiEdit = null,
        ?bool $aiRemoveBackground = null,
        ?bool $aiRemoveBackgroundExternal = null,
        ?bool $aiRetouch = null,
        ?bool $aiUpscale = null,
        ?bool $aiVariation = null,
        float|string|null $aspectRatio = null,
        AudioCodec|string|null $audioCodec = null,
        ?string $background = null,
        ?float $blur = null,
        ?string $border = null,
        ?bool $colorProfile = null,
        ?bool $contrastStretch = null,
        Crop|string|null $crop = null,
        CropMode|string|null $cropMode = null,
        ?string $defaultImage = null,
        ?float $dpr = null,
        float|string|null $duration = null,
        float|string|null $endOffset = null,
        Flip|string|null $flip = null,
        ?string $focus = null,
        Format|string|null $format = null,
        string|bool|null $gradient = null,
        ?bool $grayscale = null,
        float|string|null $height = null,
        ?bool $lossless = null,
        ?bool $metadata = null,
        ?string $named = null,
        ?float $opacity = null,
        ?bool $original = null,
        ?Overlay $overlay = null,
        float|string|null $page = null,
        ?bool $progressive = null,
        ?float $quality = null,
        float|string|null $radius = null,
        ?string $raw = null,
        float|string|null $rotation = null,
        string|bool|null $shadow = null,
        float|bool|null $sharpen = null,
        float|string|null $startOffset = null,
        ?array $streamingResolutions = null,
        float|bool|null $trim = null,
        string|bool|null $unsharpMask = null,
        VideoCodec|string|null $videoCodec = null,
        float|string|null $width = null,
        float|string|null $x = null,
        float|string|null $xCenter = null,
        float|string|null $y = null,
        float|string|null $yCenter = null,
        ?float $zoom = null,
    ): self {
        $self = new self;

        null !== $aiChangeBackground && $self['aiChangeBackground'] = $aiChangeBackground;
        null !== $aiDropShadow && $self['aiDropShadow'] = $aiDropShadow;
        null !== $aiEdit && $self['aiEdit'] = $aiEdit;
        null !== $aiRemoveBackground && $self['aiRemoveBackground'] = $aiRemoveBackground;
        null !== $aiRemoveBackgroundExternal && $self['aiRemoveBackgroundExternal'] = $aiRemoveBackgroundExternal;
        null !== $aiRetouch && $self['aiRetouch'] = $aiRetouch;
        null !== $aiUpscale && $self['aiUpscale'] = $aiUpscale;
        null !== $aiVariation && $self['aiVariation'] = $aiVariation;
        null !== $aspectRatio && $self['aspectRatio'] = $aspectRatio;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $background && $self['background'] = $background;
        null !== $blur && $self['blur'] = $blur;
        null !== $border && $self['border'] = $border;
        null !== $colorProfile && $self['colorProfile'] = $colorProfile;
        null !== $contrastStretch && $self['contrastStretch'] = $contrastStretch;
        null !== $crop && $self['crop'] = $crop;
        null !== $cropMode && $self['cropMode'] = $cropMode;
        null !== $defaultImage && $self['defaultImage'] = $defaultImage;
        null !== $dpr && $self['dpr'] = $dpr;
        null !== $duration && $self['duration'] = $duration;
        null !== $endOffset && $self['endOffset'] = $endOffset;
        null !== $flip && $self['flip'] = $flip;
        null !== $focus && $self['focus'] = $focus;
        null !== $format && $self['format'] = $format;
        null !== $gradient && $self['gradient'] = $gradient;
        null !== $grayscale && $self['grayscale'] = $grayscale;
        null !== $height && $self['height'] = $height;
        null !== $lossless && $self['lossless'] = $lossless;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $named && $self['named'] = $named;
        null !== $opacity && $self['opacity'] = $opacity;
        null !== $original && $self['original'] = $original;
        null !== $overlay && $self['overlay'] = $overlay;
        null !== $page && $self['page'] = $page;
        null !== $progressive && $self['progressive'] = $progressive;
        null !== $quality && $self['quality'] = $quality;
        null !== $radius && $self['radius'] = $radius;
        null !== $raw && $self['raw'] = $raw;
        null !== $rotation && $self['rotation'] = $rotation;
        null !== $shadow && $self['shadow'] = $shadow;
        null !== $sharpen && $self['sharpen'] = $sharpen;
        null !== $startOffset && $self['startOffset'] = $startOffset;
        null !== $streamingResolutions && $self['streamingResolutions'] = $streamingResolutions;
        null !== $trim && $self['trim'] = $trim;
        null !== $unsharpMask && $self['unsharpMask'] = $unsharpMask;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;
        null !== $x && $self['x'] = $x;
        null !== $xCenter && $self['xCenter'] = $xCenter;
        null !== $y && $self['y'] = $y;
        null !== $yCenter && $self['yCenter'] = $yCenter;
        null !== $zoom && $self['zoom'] = $zoom;

        return $self;
    }

    /**
     * Uses AI to change the background. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Change Background](https://imagekit.io/docs/ai-transformations#change-background-e-changebg).
     */
    public function withAIChangeBackground(string $aiChangeBackground): self
    {
        $self = clone $this;
        $self['aiChangeBackground'] = $aiChangeBackground;

        return $self;
    }

    /**
     * Adds an AI-based drop shadow around a foreground object on a transparent or removed background.
     * Optionally, control the direction, elevation, and saturation of the light source (e.g., `az-45` to change light direction).
     * Pass `true` for the default drop shadow, or provide a string for a custom drop shadow.
     * Supported inside overlay.
     * See [AI Drop Shadow](https://imagekit.io/docs/ai-transformations#ai-drop-shadow-e-dropshadow).
     */
    public function withAIDropShadow(string|bool $aiDropShadow): self
    {
        $self = clone $this;
        $self['aiDropShadow'] = $aiDropShadow;

        return $self;
    }

    /**
     * Uses AI to edit images based on a text prompt. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Edit](https://imagekit.io/docs/ai-transformations#edit-image-e-edit).
     */
    public function withAIEdit(string $aiEdit): self
    {
        $self = clone $this;
        $self['aiEdit'] = $aiEdit;

        return $self;
    }

    /**
     * Applies ImageKit's in-house background removal.
     * Supported inside overlay.
     * See [AI Background Removal](https://imagekit.io/docs/ai-transformations#imagekit-background-removal-e-bgremove).
     */
    public function withAIRemoveBackground(bool $aiRemoveBackground): self
    {
        $self = clone $this;
        $self['aiRemoveBackground'] = $aiRemoveBackground;

        return $self;
    }

    /**
     * Uses third-party background removal.
     * Note: It is recommended to use aiRemoveBackground, ImageKit's in-house solution, which is more cost-effective.
     * Supported inside overlay.
     * See [External Background Removal](https://imagekit.io/docs/ai-transformations#background-removal-e-removedotbg).
     */
    public function withAIRemoveBackgroundExternal(
        bool $aiRemoveBackgroundExternal
    ): self {
        $self = clone $this;
        $self['aiRemoveBackgroundExternal'] = $aiRemoveBackgroundExternal;

        return $self;
    }

    /**
     * Performs AI-based retouching to improve faces or product shots. Not supported inside overlay.
     * See [AI Retouch](https://imagekit.io/docs/ai-transformations#retouch-e-retouch).
     */
    public function withAIRetouch(bool $aiRetouch): self
    {
        $self = clone $this;
        $self['aiRetouch'] = $aiRetouch;

        return $self;
    }

    /**
     * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
     * See [AI Upscale](https://imagekit.io/docs/ai-transformations#upscale-e-upscale).
     */
    public function withAIUpscale(bool $aiUpscale): self
    {
        $self = clone $this;
        $self['aiUpscale'] = $aiUpscale;

        return $self;
    }

    /**
     * Generates a variation of an image using AI. This produces a new image with slight variations from the original,
     * such as changes in color, texture, and other visual elements, while preserving the structure and essence of the original image. Not supported inside overlay.
     * See [AI Generate Variations](https://imagekit.io/docs/ai-transformations#generate-variations-of-an-image-e-genvar).
     */
    public function withAIVariation(bool $aiVariation): self
    {
        $self = clone $this;
        $self['aiVariation'] = $aiVariation;

        return $self;
    }

    /**
     * Specifies the aspect ratio for the output, e.g., "ar-4-3". Typically used with either width or height (but not both).
     * For example: aspectRatio = `4:3`, `4_3`, or an expression like `iar_div_2`.
     * See [Image resize and crop – Aspect ratio](https://imagekit.io/docs/image-resize-and-crop#aspect-ratio---ar).
     */
    public function withAspectRatio(float|string $aspectRatio): self
    {
        $self = clone $this;
        $self['aspectRatio'] = $aspectRatio;

        return $self;
    }

    /**
     * Specifies the audio codec, e.g., `aac`, `opus`, or `none`. See [Audio codec](https://imagekit.io/docs/video-optimization#audio-codec---ac).
     *
     * @param AudioCodec|value-of<AudioCodec> $audioCodec
     */
    public function withAudioCodec(AudioCodec|string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * Specifies the background to be used in conjunction with certain cropping strategies when resizing an image.
     * - A solid color: e.g., `red`, `F3F3F3`, `AAFF0010`. See [Solid color background](https://imagekit.io/docs/effects-and-enhancements#solid-color-background).
     * - A blurred background: e.g., `blurred`, `blurred_25_N15`, etc. See [Blurred background](https://imagekit.io/docs/effects-and-enhancements#blurred-background).
     * - Expand the image boundaries using generative fill: `genfill`. Not supported inside overlay. Optionally, control the background scene by passing a text prompt:
     *   `genfill[:-prompt-${text}]` or `genfill[:-prompte-${urlencoded_base64_encoded_text}]`. See [Generative fill background](https://imagekit.io/docs/ai-transformations#generative-fill-bg-genfill).
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Specifies the Gaussian blur level. Accepts an integer value between 1 and 100, or an expression like `bl-10`.
     * See [Blur](https://imagekit.io/docs/effects-and-enhancements#blur---bl).
     */
    public function withBlur(float $blur): self
    {
        $self = clone $this;
        $self['blur'] = $blur;

        return $self;
    }

    /**
     * Adds a border to the output media. Accepts a string in the format `<border-width>_<hex-code>`
     * (e.g., `5_FFF000` for a 5px yellow border), or an expression like `ih_div_20_FF00FF`.
     * See [Border](https://imagekit.io/docs/effects-and-enhancements#border---b).
     */
    public function withBorder(string $border): self
    {
        $self = clone $this;
        $self['border'] = $border;

        return $self;
    }

    /**
     * Indicates whether the output image should retain the original color profile.
     * See [Color profile](https://imagekit.io/docs/image-optimization#color-profile---cp).
     */
    public function withColorProfile(bool $colorProfile): self
    {
        $self = clone $this;
        $self['colorProfile'] = $colorProfile;

        return $self;
    }

    /**
     * Automatically enhances the contrast of an image (contrast stretch).
     * See [Contrast Stretch](https://imagekit.io/docs/effects-and-enhancements#contrast-stretch---e-contrast).
     */
    public function withContrastStretch(bool $contrastStretch): self
    {
        $self = clone $this;
        $self['contrastStretch'] = $contrastStretch;

        return $self;
    }

    /**
     * Crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @param Crop|value-of<Crop> $crop
     */
    public function withCrop(Crop|string $crop): self
    {
        $self = clone $this;
        $self['crop'] = $crop;

        return $self;
    }

    /**
     * Additional crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @param CropMode|value-of<CropMode> $cropMode
     */
    public function withCropMode(CropMode|string $cropMode): self
    {
        $self = clone $this;
        $self['cropMode'] = $cropMode;

        return $self;
    }

    /**
     * Specifies a fallback image if the resource is not found, e.g., a URL or file path.
     * See [Default image](https://imagekit.io/docs/image-transformation#default-image---di).
     */
    public function withDefaultImage(string $defaultImage): self
    {
        $self = clone $this;
        $self['defaultImage'] = $defaultImage;

        return $self;
    }

    /**
     * Accepts values between 0.1 and 5, or `auto` for automatic device pixel ratio (DPR) calculation.
     * See [DPR](https://imagekit.io/docs/image-resize-and-crop#dpr---dpr).
     */
    public function withDpr(float $dpr): self
    {
        $self = clone $this;
        $self['dpr'] = $dpr;

        return $self;
    }

    /**
     * Specifies the duration (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to indicate the length from the start offset. Arithmetic expressions are supported.
     * See [Trim videos – Duration](https://imagekit.io/docs/trim-videos#duration---du).
     */
    public function withDuration(float|string $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
     * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
     */
    public function withEndOffset(float|string $endOffset): self
    {
        $self = clone $this;
        $self['endOffset'] = $endOffset;

        return $self;
    }

    /**
     * Flips or mirrors an image either horizontally, vertically, or both.
     * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
     * See [Flip](https://imagekit.io/docs/effects-and-enhancements#flip---fl).
     *
     * @param Flip|value-of<Flip> $flip
     */
    public function withFlip(Flip|string $flip): self
    {
        $self = clone $this;
        $self['flip'] = $flip;

        return $self;
    }

    /**
     * Refines padding and cropping behavior for pad resize, maintain ratio, and extract crop modes.
     * Supports manual positions and coordinate-based focus. With AI-based cropping, you can automatically
     * keep key subjects in frame—such as faces or detected objects (e.g., `fo-face`, `fo-person`, `fo-car`)—
     * while resizing.
     * - See [Focus](https://imagekit.io/docs/image-resize-and-crop#focus---fo).
     * - [Object aware cropping](https://imagekit.io/docs/image-resize-and-crop#object-aware-cropping---fo-object-name).
     */
    public function withFocus(string $focus): self
    {
        $self = clone $this;
        $self['focus'] = $focus;

        return $self;
    }

    /**
     * Specifies the output format for images or videos, e.g., `jpg`, `png`, `webp`, `mp4`, or `auto`.
     * You can also pass `orig` for images to return the original format.
     * ImageKit automatically delivers images and videos in the optimal format based on device support unless overridden by the dashboard settings or the format parameter.
     * See [Image format](https://imagekit.io/docs/image-optimization#format---f) and [Video format](https://imagekit.io/docs/video-optimization#format---f).
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    public function withGradient(string|bool $gradient): self
    {
        $self = clone $this;
        $self['gradient'] = $gradient;

        return $self;
    }

    /**
     * Enables a grayscale effect for images. See [Grayscale](https://imagekit.io/docs/effects-and-enhancements#grayscale---e-grayscale).
     */
    public function withGrayscale(bool $grayscale): self
    {
        $self = clone $this;
        $self['grayscale'] = $grayscale;

        return $self;
    }

    /**
     * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
     * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
     * Height transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#height---h) · [Videos](https://imagekit.io/docs/video-resize-and-crop#height---h).
     */
    public function withHeight(float|string $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Specifies whether the output image (in JPEG or PNG) should be compressed losslessly.
     * See [Lossless compression](https://imagekit.io/docs/image-optimization#lossless-webp-and-png---lo).
     */
    public function withLossless(bool $lossless): self
    {
        $self = clone $this;
        $self['lossless'] = $lossless;

        return $self;
    }

    /**
     * By default, ImageKit removes all metadata during automatic image compression.
     * Set this to true to preserve metadata.
     * See [Image metadata](https://imagekit.io/docs/image-optimization#image-metadata---md).
     */
    public function withMetadata(bool $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Named transformation reference. See [Named transformations](https://imagekit.io/docs/transformations#named-transformations).
     */
    public function withNamed(string $named): self
    {
        $self = clone $this;
        $self['named'] = $named;

        return $self;
    }

    /**
     * Specifies the opacity level of the output image. See [Opacity](https://imagekit.io/docs/effects-and-enhancements#opacity---o).
     */
    public function withOpacity(float $opacity): self
    {
        $self = clone $this;
        $self['opacity'] = $opacity;

        return $self;
    }

    /**
     * If set to true, serves the original file without applying any transformations.
     * See [Deliver original file as-is](https://imagekit.io/docs/core-delivery-features#deliver-original-file-as-is---orig-true).
     */
    public function withOriginal(bool $original): self
    {
        $self = clone $this;
        $self['original'] = $original;

        return $self;
    }

    /**
     * Specifies an overlay to be applied on the parent image or video.
     * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
     * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
     */
    public function withOverlay(Overlay $overlay): self
    {
        $self = clone $this;
        $self['overlay'] = $overlay;

        return $self;
    }

    /**
     * Extracts a specific page or frame from multi-page or layered files (PDF, PSD, AI).
     * For example, specify by number (e.g., `2`), a range (e.g., `3-4` for the 2nd and 3rd layers),
     * or by name (e.g., `name-layer-4` for a PSD layer).
     * See [Thumbnail extraction](https://imagekit.io/docs/vector-and-animated-images#get-thumbnail-from-psd-pdf-ai-eps-and-animated-files).
     */
    public function withPage(float|string $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Specifies whether the output JPEG image should be rendered progressively. Progressive loading begins with a low-quality,
     * pixelated version of the full image, which gradually improves to provide a faster perceived load time.
     * See [Progressive images](https://imagekit.io/docs/image-optimization#progressive-image---pr).
     */
    public function withProgressive(bool $progressive): self
    {
        $self = clone $this;
        $self['progressive'] = $progressive;

        return $self;
    }

    /**
     * Specifies the quality of the output image for lossy formats such as JPEG, WebP, and AVIF.
     * A higher quality value results in a larger file size with better quality, while a lower value produces a smaller file size with reduced quality.
     * See [Quality](https://imagekit.io/docs/image-optimization#quality---q).
     */
    public function withQuality(float $quality): self
    {
        $self = clone $this;
        $self['quality'] = $quality;

        return $self;
    }

    /**
     * Specifies the corner radius for rounded corners (e.g., 20) or `max` for circular or oval shape.
     * See [Radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     *
     * @param float|'max' $radius
     */
    public function withRadius(float|string $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * Pass any transformation not directly supported by the SDK.
     * This transformation string is appended to the URL as provided.
     */
    public function withRaw(string $raw): self
    {
        $self = clone $this;
        $self['raw'] = $raw;

        return $self;
    }

    /**
     * Specifies the rotation angle in degrees. Positive values rotate the image clockwise; you can also use, for example, `N40` for counterclockwise rotation
     * or `auto` to use the orientation specified in the image's EXIF data.
     * For videos, only the following values are supported: 0, 90, 180, 270, or 360.
     * See [Rotate](https://imagekit.io/docs/effects-and-enhancements#rotate---rt).
     */
    public function withRotation(float|string $rotation): self
    {
        $self = clone $this;
        $self['rotation'] = $rotation;

        return $self;
    }

    /**
     * Adds a shadow beneath solid objects in an image with a transparent background.
     * For AI-based drop shadows, refer to aiDropShadow.
     * Pass `true` for a default shadow, or provide a string for a custom shadow.
     * See [Shadow](https://imagekit.io/docs/effects-and-enhancements#shadow---e-shadow).
     */
    public function withShadow(string|bool $shadow): self
    {
        $self = clone $this;
        $self['shadow'] = $shadow;

        return $self;
    }

    /**
     * Sharpens the input image, highlighting edges and finer details.
     * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
     * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
     */
    public function withSharpen(float|bool $sharpen): self
    {
        $self = clone $this;
        $self['sharpen'] = $sharpen;

        return $self;
    }

    /**
     * Specifies the start offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Arithmetic expressions are also supported.
     * See [Trim videos – Start offset](https://imagekit.io/docs/trim-videos#start-offset---so).
     */
    public function withStartOffset(float|string $startOffset): self
    {
        $self = clone $this;
        $self['startOffset'] = $startOffset;

        return $self;
    }

    /**
     * An array of resolutions for adaptive bitrate streaming, e.g., [`240`, `360`, `480`, `720`, `1080`].
     * See [Adaptive Bitrate Streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
     *
     * @param list<StreamingResolution|value-of<StreamingResolution>> $streamingResolutions
     */
    public function withStreamingResolutions(array $streamingResolutions): self
    {
        $self = clone $this;
        $self['streamingResolutions'] = $streamingResolutions;

        return $self;
    }

    /**
     * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
     * leaving only the central object in the output image.
     * See [Trim edges](https://imagekit.io/docs/effects-and-enhancements#trim-edges---t).
     */
    public function withTrim(float|bool $trim): self
    {
        $self = clone $this;
        $self['trim'] = $trim;

        return $self;
    }

    /**
     * Applies Unsharp Masking (USM), an image sharpening technique.
     * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
     * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
     */
    public function withUnsharpMask(string|bool $unsharpMask): self
    {
        $self = clone $this;
        $self['unsharpMask'] = $unsharpMask;

        return $self;
    }

    /**
     * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`. See [Video codec](https://imagekit.io/docs/video-optimization#video-codec---vc).
     *
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public function withVideoCodec(VideoCodec|string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
     * You can also supply arithmetic expressions (e.g., `iw_div_2`).
     * Width transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#width---w) · [Videos](https://imagekit.io/docs/video-resize-and-crop#width---w).
     */
    public function withWidth(float|string $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Focus using cropped image coordinates - X coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withX(float|string $x): self
    {
        $self = clone $this;
        $self['x'] = $x;

        return $self;
    }

    /**
     * Focus using cropped image coordinates - X center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withXCenter(float|string $xCenter): self
    {
        $self = clone $this;
        $self['xCenter'] = $xCenter;

        return $self;
    }

    /**
     * Focus using cropped image coordinates - Y coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withY(float|string $y): self
    {
        $self = clone $this;
        $self['y'] = $y;

        return $self;
    }

    /**
     * Focus using cropped image coordinates - Y center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withYCenter(float|string $yCenter): self
    {
        $self = clone $this;
        $self['yCenter'] = $yCenter;

        return $self;
    }

    /**
     * Accepts a numeric value that determines how much to zoom in or out of the cropped area.
     * It should be used in conjunction with fo-face or fo-<object_name>.
     * See [Zoom](https://imagekit.io/docs/image-resize-and-crop#zoom---z).
     */
    public function withZoom(float $zoom): self
    {
        $self = clone $this;
        $self['zoom'] = $zoom;

        return $self;
    }
}
