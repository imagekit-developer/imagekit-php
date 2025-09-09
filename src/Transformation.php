<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Transformation\AudioCodec;
use ImageKit\Transformation\Crop;
use ImageKit\Transformation\CropMode;
use ImageKit\Transformation\Flip;
use ImageKit\Transformation\Format;
use ImageKit\Transformation\VideoCodec;

/**
 * The SDK provides easy-to-use names for transformations. These names are converted to the corresponding transformation string before being added to the URL.
 * SDKs are updated regularly to support new transformations. If you want to use a transformation that is not supported by the SDK,
 * You can use the `raw` parameter to pass the transformation string directly.
 * See the [Transformations documentation](https://imagekit.io/docs/transformations).
 *
 * @phpstan-type transformation_alias = array{
 *   aiChangeBackground?: string|null,
 *   aiDropShadow?: bool|string|null,
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
 *   gradient?: bool|string|null,
 *   grayscale?: bool|null,
 *   height?: float|string|null,
 *   lossless?: bool|null,
 *   metadata?: bool|null,
 *   named?: string|null,
 *   opacity?: float|null,
 *   original?: bool|null,
 *   overlay?: null|TextOverlay|ImageOverlay|VideoOverlay|SubtitleOverlay|SolidColorOverlay,
 *   page?: float|string|null,
 *   progressive?: bool|null,
 *   quality?: float|null,
 *   radius?: float|string|null,
 *   raw?: string|null,
 *   rotation?: float|string|null,
 *   shadow?: bool|string|null,
 *   sharpen?: bool|float|null,
 *   startOffset?: float|string|null,
 *   streamingResolutions?: list<value-of<StreamingResolution>>|null,
 *   trim?: bool|float|null,
 *   unsharpMask?: bool|string|null,
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
    /** @use SdkModel<transformation_alias> */
    use SdkModel;

    /**
     * Uses AI to change the background. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Change Background](https://imagekit.io/docs/ai-transformations#change-background-e-changebg).
     */
    #[Api(optional: true)]
    public ?string $aiChangeBackground;

    /**
     * Adds an AI-based drop shadow around a foreground object on a transparent or removed background.
     * Optionally, control the direction, elevation, and saturation of the light source (e.g., `az-45` to change light direction).
     * Pass `true` for the default drop shadow, or provide a string for a custom drop shadow.
     * Supported inside overlay.
     * See [AI Drop Shadow](https://imagekit.io/docs/ai-transformations#ai-drop-shadow-e-dropshadow).
     */
    #[Api(optional: true)]
    public bool|string|null $aiDropShadow;

    /**
     * Uses AI to edit images based on a text prompt. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Edit](https://imagekit.io/docs/ai-transformations#edit-image-e-edit).
     */
    #[Api(optional: true)]
    public ?string $aiEdit;

    /**
     * Applies ImageKit's in-house background removal.
     * Supported inside overlay.
     * See [AI Background Removal](https://imagekit.io/docs/ai-transformations#imagekit-background-removal-e-bgremove).
     */
    #[Api(enum: STAINLESS_FIXME_AIRemoveBackground::class, optional: true)]
    public ?bool $aiRemoveBackground;

    /**
     * Uses third-party background removal.
     * Note: It is recommended to use aiRemoveBackground, ImageKit's in-house solution, which is more cost-effective.
     * Supported inside overlay.
     * See [External Background Removal](https://imagekit.io/docs/ai-transformations#background-removal-e-removedotbg).
     */
    #[Api(
        enum: STAINLESS_FIXME_AIRemoveBackgroundExternal::class,
        optional: true
    )]
    public ?bool $aiRemoveBackgroundExternal;

    /**
     * Performs AI-based retouching to improve faces or product shots. Not supported inside overlay.
     * See [AI Retouch](https://imagekit.io/docs/ai-transformations#retouch-e-retouch).
     */
    #[Api(enum: STAINLESS_FIXME_AIRetouch::class, optional: true)]
    public ?bool $aiRetouch;

    /**
     * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
     * See [AI Upscale](https://imagekit.io/docs/ai-transformations#upscale-e-upscale).
     */
    #[Api(enum: STAINLESS_FIXME_AIUpscale::class, optional: true)]
    public ?bool $aiUpscale;

    /**
     * Generates a variation of an image using AI. This produces a new image with slight variations from the original,
     * such as changes in color, texture, and other visual elements, while preserving the structure and essence of the original image. Not supported inside overlay.
     * See [AI Generate Variations](https://imagekit.io/docs/ai-transformations#generate-variations-of-an-image-e-genvar).
     */
    #[Api(enum: STAINLESS_FIXME_AIVariation::class, optional: true)]
    public ?bool $aiVariation;

    /**
     * Specifies the aspect ratio for the output, e.g., "ar-4-3". Typically used with either width or height (but not both).
     * For example: aspectRatio = `4:3`, `4_3`, or an expression like `iar_div_2`.
     * See [Image resize and crop – Aspect ratio](https://imagekit.io/docs/image-resize-and-crop#aspect-ratio---ar).
     */
    #[Api(optional: true)]
    public float|string|null $aspectRatio;

    /**
     * Specifies the audio codec, e.g., `aac`, `opus`, or `none`. See [Audio codec](https://imagekit.io/docs/video-optimization#audio-codec---ac).
     *
     * @var value-of<AudioCodec>|null $audioCodec
     */
    #[Api(enum: AudioCodec::class, optional: true)]
    public ?string $audioCodec;

    /**
     * Specifies the background to be used in conjunction with certain cropping strategies when resizing an image.
     * - A solid color: e.g., `red`, `F3F3F3`, `AAFF0010`. See [Solid color background](https://imagekit.io/docs/effects-and-enhancements#solid-color-background).
     * - A blurred background: e.g., `blurred`, `blurred_25_N15`, etc. See [Blurred background](https://imagekit.io/docs/effects-and-enhancements#blurred-background).
     * - Expand the image boundaries using generative fill: `genfill`. Not supported inside overlay. Optionally, control the background scene by passing a text prompt:
     *   `genfill[:-prompt-${text}]` or `genfill[:-prompte-${urlencoded_base64_encoded_text}]`. See [Generative fill background](https://imagekit.io/docs/ai-transformations#generative-fill-bg-genfill).
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Specifies the Gaussian blur level. Accepts an integer value between 1 and 100, or an expression like `bl-10`.
     * See [Blur](https://imagekit.io/docs/effects-and-enhancements#blur---bl).
     */
    #[Api(optional: true)]
    public ?float $blur;

    /**
     * Adds a border to the output media. Accepts a string in the format `<border-width>_<hex-code>`
     * (e.g., `5_FFF000` for a 5px yellow border), or an expression like `ih_div_20_FF00FF`.
     * See [Border](https://imagekit.io/docs/effects-and-enhancements#border---b).
     */
    #[Api(optional: true)]
    public ?string $border;

    /**
     * Indicates whether the output image should retain the original color profile.
     * See [Color profile](https://imagekit.io/docs/image-optimization#color-profile---cp).
     */
    #[Api(optional: true)]
    public ?bool $colorProfile;

    /**
     * Automatically enhances the contrast of an image (contrast stretch).
     * See [Contrast Stretch](https://imagekit.io/docs/effects-and-enhancements#contrast-stretch---e-contrast).
     */
    #[Api(enum: STAINLESS_FIXME_ContrastStretch::class, optional: true)]
    public ?bool $contrastStretch;

    /**
     * Crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @var value-of<Crop>|null $crop
     */
    #[Api(enum: Crop::class, optional: true)]
    public ?string $crop;

    /**
     * Additional crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @var value-of<CropMode>|null $cropMode
     */
    #[Api(enum: CropMode::class, optional: true)]
    public ?string $cropMode;

    /**
     * Specifies a fallback image if the resource is not found, e.g., a URL or file path.
     * See [Default image](https://imagekit.io/docs/image-transformation#default-image---di).
     */
    #[Api(optional: true)]
    public ?string $defaultImage;

    /**
     * Accepts values between 0.1 and 5, or `auto` for automatic device pixel ratio (DPR) calculation.
     * See [DPR](https://imagekit.io/docs/image-resize-and-crop#dpr---dpr).
     */
    #[Api(optional: true)]
    public ?float $dpr;

    /**
     * Specifies the duration (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to indicate the length from the start offset. Arithmetic expressions are supported.
     * See [Trim videos – Duration](https://imagekit.io/docs/trim-videos#duration---du).
     */
    #[Api(optional: true)]
    public float|string|null $duration;

    /**
     * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
     * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
     */
    #[Api(optional: true)]
    public float|string|null $endOffset;

    /**
     * Flips or mirrors an image either horizontally, vertically, or both.
     * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
     * See [Flip](https://imagekit.io/docs/effects-and-enhancements#flip---fl).
     *
     * @var value-of<Flip>|null $flip
     */
    #[Api(enum: Flip::class, optional: true)]
    public ?string $flip;

    /**
     * Refines padding and cropping behavior for pad resize, maintain ratio, and extract crop modes.
     * Supports manual positions and coordinate-based focus. With AI-based cropping, you can automatically
     * keep key subjects in frame—such as faces or detected objects (e.g., `fo-face`, `fo-person`, `fo-car`)—
     * while resizing.
     * - See [Focus](https://imagekit.io/docs/image-resize-and-crop#focus---fo).
     * - [Object aware cropping](https://imagekit.io/docs/image-resize-and-crop#object-aware-cropping---fo-object-name).
     */
    #[Api(optional: true)]
    public ?string $focus;

    /**
     * Specifies the output format for images or videos, e.g., `jpg`, `png`, `webp`, `mp4`, or `auto`.
     * You can also pass `orig` for images to return the original format.
     * ImageKit automatically delivers images and videos in the optimal format based on device support unless overridden by the dashboard settings or the format parameter.
     * See [Image format](https://imagekit.io/docs/image-optimization#format---f) and [Video format](https://imagekit.io/docs/video-optimization#format---f).
     *
     * @var value-of<Format>|null $format
     */
    #[Api(enum: Format::class, optional: true)]
    public ?string $format;

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    #[Api(optional: true)]
    public bool|string|null $gradient;

    /**
     * Enables a grayscale effect for images. See [Grayscale](https://imagekit.io/docs/effects-and-enhancements#grayscale---e-grayscale).
     */
    #[Api(enum: STAINLESS_FIXME_Grayscale::class, optional: true)]
    public ?bool $grayscale;

    /**
     * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
     * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
     * Height transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#height---h) · [Videos](https://imagekit.io/docs/video-resize-and-crop#height---h).
     */
    #[Api(optional: true)]
    public float|string|null $height;

    /**
     * Specifies whether the output image (in JPEG or PNG) should be compressed losslessly.
     * See [Lossless compression](https://imagekit.io/docs/image-optimization#lossless-webp-and-png---lo).
     */
    #[Api(optional: true)]
    public ?bool $lossless;

    /**
     * By default, ImageKit removes all metadata during automatic image compression.
     * Set this to true to preserve metadata.
     * See [Image metadata](https://imagekit.io/docs/image-optimization#image-metadata---md).
     */
    #[Api(optional: true)]
    public ?bool $metadata;

    /**
     * Named transformation reference. See [Named transformations](https://imagekit.io/docs/transformations#named-transformations).
     */
    #[Api(optional: true)]
    public ?string $named;

    /**
     * Specifies the opacity level of the output image. See [Opacity](https://imagekit.io/docs/effects-and-enhancements#opacity---o).
     */
    #[Api(optional: true)]
    public ?float $opacity;

    /**
     * If set to true, serves the original file without applying any transformations.
     * See [Deliver original file as-is](https://imagekit.io/docs/core-delivery-features#deliver-original-file-as-is---orig-true).
     */
    #[Api(optional: true)]
    public ?bool $original;

    /**
     * Specifies an overlay to be applied on the parent image or video.
     * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
     * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
     */
    #[Api(union: Overlay::class, optional: true)]
    public TextOverlay|ImageOverlay|VideoOverlay|SubtitleOverlay|SolidColorOverlay|null $overlay;

    /**
     * Extracts a specific page or frame from multi-page or layered files (PDF, PSD, AI).
     * For example, specify by number (e.g., `2`), a range (e.g., `3-4` for the 2nd and 3rd layers),
     * or by name (e.g., `name-layer-4` for a PSD layer).
     * See [Thumbnail extraction](https://imagekit.io/docs/vector-and-animated-images#get-thumbnail-from-psd-pdf-ai-eps-and-animated-files).
     */
    #[Api(optional: true)]
    public float|string|null $page;

    /**
     * Specifies whether the output JPEG image should be rendered progressively. Progressive loading begins with a low-quality,
     * pixelated version of the full image, which gradually improves to provide a faster perceived load time.
     * See [Progressive images](https://imagekit.io/docs/image-optimization#progressive-image---pr).
     */
    #[Api(optional: true)]
    public ?bool $progressive;

    /**
     * Specifies the quality of the output image for lossy formats such as JPEG, WebP, and AVIF.
     * A higher quality value results in a larger file size with better quality, while a lower value produces a smaller file size with reduced quality.
     * See [Quality](https://imagekit.io/docs/image-optimization#quality---q).
     */
    #[Api(optional: true)]
    public ?float $quality;

    /**
     * Specifies the corner radius for rounded corners (e.g., 20) or `max` for circular or oval shape.
     * See [Radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     */
    #[Api(optional: true)]
    public float|string|null $radius;

    /**
     * Pass any transformation not directly supported by the SDK.
     * This transformation string is appended to the URL as provided.
     */
    #[Api(optional: true)]
    public ?string $raw;

    /**
     * Specifies the rotation angle in degrees. Positive values rotate the image clockwise; you can also use, for example, `N40` for counterclockwise rotation
     * or `auto` to use the orientation specified in the image's EXIF data.
     * For videos, only the following values are supported: 0, 90, 180, 270, or 360.
     * See [Rotate](https://imagekit.io/docs/effects-and-enhancements#rotate---rt).
     */
    #[Api(optional: true)]
    public float|string|null $rotation;

    /**
     * Adds a shadow beneath solid objects in an image with a transparent background.
     * For AI-based drop shadows, refer to aiDropShadow.
     * Pass `true` for a default shadow, or provide a string for a custom shadow.
     * See [Shadow](https://imagekit.io/docs/effects-and-enhancements#shadow---e-shadow).
     */
    #[Api(optional: true)]
    public bool|string|null $shadow;

    /**
     * Sharpens the input image, highlighting edges and finer details.
     * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
     * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
     */
    #[Api(optional: true)]
    public bool|float|null $sharpen;

    /**
     * Specifies the start offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Arithmetic expressions are also supported.
     * See [Trim videos – Start offset](https://imagekit.io/docs/trim-videos#start-offset---so).
     */
    #[Api(optional: true)]
    public float|string|null $startOffset;

    /**
     * An array of resolutions for adaptive bitrate streaming, e.g., [`240`, `360`, `480`, `720`, `1080`].
     * See [Adaptive Bitrate Streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
     *
     * @var list<value-of<StreamingResolution>>|null $streamingResolutions
     */
    #[Api(list: StreamingResolution::class, optional: true)]
    public ?array $streamingResolutions;

    /**
     * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
     * leaving only the central object in the output image.
     * See [Trim edges](https://imagekit.io/docs/effects-and-enhancements#trim-edges---t).
     */
    #[Api(optional: true)]
    public bool|float|null $trim;

    /**
     * Applies Unsharp Masking (USM), an image sharpening technique.
     * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
     * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
     */
    #[Api(optional: true)]
    public bool|string|null $unsharpMask;

    /**
     * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`. See [Video codec](https://imagekit.io/docs/video-optimization#video-codec---vc).
     *
     * @var value-of<VideoCodec>|null $videoCodec
     */
    #[Api(enum: VideoCodec::class, optional: true)]
    public ?string $videoCodec;

    /**
     * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
     * You can also supply arithmetic expressions (e.g., `iw_div_2`).
     * Width transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#width---w) · [Videos](https://imagekit.io/docs/video-resize-and-crop#width---w).
     */
    #[Api(optional: true)]
    public float|string|null $width;

    /**
     * Focus using cropped image coordinates - X coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Api(optional: true)]
    public float|string|null $x;

    /**
     * Focus using cropped image coordinates - X center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Api(optional: true)]
    public float|string|null $xCenter;

    /**
     * Focus using cropped image coordinates - Y coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Api(optional: true)]
    public float|string|null $y;

    /**
     * Focus using cropped image coordinates - Y center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    #[Api(optional: true)]
    public float|string|null $yCenter;

    /**
     * Accepts a numeric value that determines how much to zoom in or out of the cropped area.
     * It should be used in conjunction with fo-face or fo-<object_name>.
     * See [Zoom](https://imagekit.io/docs/image-resize-and-crop#zoom---z).
     */
    #[Api(optional: true)]
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
     * @param list<StreamingResolution|value-of<StreamingResolution>> $streamingResolutions
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public static function with(
        ?string $aiChangeBackground = null,
        bool|string|null $aiDropShadow = null,
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
        bool|string|null $gradient = null,
        ?bool $grayscale = null,
        float|string|null $height = null,
        ?bool $lossless = null,
        ?bool $metadata = null,
        ?string $named = null,
        ?float $opacity = null,
        ?bool $original = null,
        TextOverlay|ImageOverlay|VideoOverlay|SubtitleOverlay|SolidColorOverlay|null $overlay = null,
        float|string|null $page = null,
        ?bool $progressive = null,
        ?float $quality = null,
        float|string|null $radius = null,
        ?string $raw = null,
        float|string|null $rotation = null,
        bool|string|null $shadow = null,
        bool|float|null $sharpen = null,
        float|string|null $startOffset = null,
        ?array $streamingResolutions = null,
        bool|float|null $trim = null,
        bool|string|null $unsharpMask = null,
        VideoCodec|string|null $videoCodec = null,
        float|string|null $width = null,
        float|string|null $x = null,
        float|string|null $xCenter = null,
        float|string|null $y = null,
        float|string|null $yCenter = null,
        ?float $zoom = null,
    ): self {
        $obj = new self;

        null !== $aiChangeBackground && $obj->aiChangeBackground = $aiChangeBackground;
        null !== $aiDropShadow && $obj->aiDropShadow = $aiDropShadow;
        null !== $aiEdit && $obj->aiEdit = $aiEdit;
        null !== $aiRemoveBackground && $obj->aiRemoveBackground = $aiRemoveBackground;
        null !== $aiRemoveBackgroundExternal && $obj->aiRemoveBackgroundExternal = $aiRemoveBackgroundExternal;
        null !== $aiRetouch && $obj->aiRetouch = $aiRetouch;
        null !== $aiUpscale && $obj->aiUpscale = $aiUpscale;
        null !== $aiVariation && $obj->aiVariation = $aiVariation;
        null !== $aspectRatio && $obj->aspectRatio = $aspectRatio;
        null !== $audioCodec && $obj->audioCodec = $audioCodec instanceof AudioCodec ? $audioCodec->value : $audioCodec;
        null !== $background && $obj->background = $background;
        null !== $blur && $obj->blur = $blur;
        null !== $border && $obj->border = $border;
        null !== $colorProfile && $obj->colorProfile = $colorProfile;
        null !== $contrastStretch && $obj->contrastStretch = $contrastStretch;
        null !== $crop && $obj->crop = $crop instanceof Crop ? $crop->value : $crop;
        null !== $cropMode && $obj->cropMode = $cropMode instanceof CropMode ? $cropMode->value : $cropMode;
        null !== $defaultImage && $obj->defaultImage = $defaultImage;
        null !== $dpr && $obj->dpr = $dpr;
        null !== $duration && $obj->duration = $duration;
        null !== $endOffset && $obj->endOffset = $endOffset;
        null !== $flip && $obj->flip = $flip instanceof Flip ? $flip->value : $flip;
        null !== $focus && $obj->focus = $focus;
        null !== $format && $obj->format = $format instanceof Format ? $format->value : $format;
        null !== $gradient && $obj->gradient = $gradient;
        null !== $grayscale && $obj->grayscale = $grayscale;
        null !== $height && $obj->height = $height;
        null !== $lossless && $obj->lossless = $lossless;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $named && $obj->named = $named;
        null !== $opacity && $obj->opacity = $opacity;
        null !== $original && $obj->original = $original;
        null !== $overlay && $obj->overlay = $overlay;
        null !== $page && $obj->page = $page;
        null !== $progressive && $obj->progressive = $progressive;
        null !== $quality && $obj->quality = $quality;
        null !== $radius && $obj->radius = $radius;
        null !== $raw && $obj->raw = $raw;
        null !== $rotation && $obj->rotation = $rotation;
        null !== $shadow && $obj->shadow = $shadow;
        null !== $sharpen && $obj->sharpen = $sharpen;
        null !== $startOffset && $obj->startOffset = $startOffset;
        null !== $streamingResolutions && $obj->streamingResolutions = array_map(fn ($v) => $v instanceof StreamingResolution ? $v->value : $v, $streamingResolutions);
        null !== $trim && $obj->trim = $trim;
        null !== $unsharpMask && $obj->unsharpMask = $unsharpMask;
        null !== $videoCodec && $obj->videoCodec = $videoCodec instanceof VideoCodec ? $videoCodec->value : $videoCodec;
        null !== $width && $obj->width = $width;
        null !== $x && $obj->x = $x;
        null !== $xCenter && $obj->xCenter = $xCenter;
        null !== $y && $obj->y = $y;
        null !== $yCenter && $obj->yCenter = $yCenter;
        null !== $zoom && $obj->zoom = $zoom;

        return $obj;
    }

    /**
     * Uses AI to change the background. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Change Background](https://imagekit.io/docs/ai-transformations#change-background-e-changebg).
     */
    public function withAIChangeBackground(string $aiChangeBackground): self
    {
        $obj = clone $this;
        $obj->aiChangeBackground = $aiChangeBackground;

        return $obj;
    }

    /**
     * Adds an AI-based drop shadow around a foreground object on a transparent or removed background.
     * Optionally, control the direction, elevation, and saturation of the light source (e.g., `az-45` to change light direction).
     * Pass `true` for the default drop shadow, or provide a string for a custom drop shadow.
     * Supported inside overlay.
     * See [AI Drop Shadow](https://imagekit.io/docs/ai-transformations#ai-drop-shadow-e-dropshadow).
     */
    public function withAIDropShadow(bool|string $aiDropShadow): self
    {
        $obj = clone $this;
        $obj->aiDropShadow = $aiDropShadow;

        return $obj;
    }

    /**
     * Uses AI to edit images based on a text prompt. Provide a text prompt or a base64-encoded prompt,
     * e.g., `prompt-snow road` or `prompte-[urlencoded_base64_encoded_text]`.
     * Not supported inside overlay.
     * See [AI Edit](https://imagekit.io/docs/ai-transformations#edit-image-e-edit).
     */
    public function withAIEdit(string $aiEdit): self
    {
        $obj = clone $this;
        $obj->aiEdit = $aiEdit;

        return $obj;
    }

    /**
     * Applies ImageKit's in-house background removal.
     * Supported inside overlay.
     * See [AI Background Removal](https://imagekit.io/docs/ai-transformations#imagekit-background-removal-e-bgremove).
     */
    public function withAIRemoveBackground(bool $aiRemoveBackground): self
    {
        $obj = clone $this;
        $obj->aiRemoveBackground = $aiRemoveBackground;

        return $obj;
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
        $obj = clone $this;
        $obj->aiRemoveBackgroundExternal = $aiRemoveBackgroundExternal;

        return $obj;
    }

    /**
     * Performs AI-based retouching to improve faces or product shots. Not supported inside overlay.
     * See [AI Retouch](https://imagekit.io/docs/ai-transformations#retouch-e-retouch).
     */
    public function withAIRetouch(bool $aiRetouch): self
    {
        $obj = clone $this;
        $obj->aiRetouch = $aiRetouch;

        return $obj;
    }

    /**
     * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
     * See [AI Upscale](https://imagekit.io/docs/ai-transformations#upscale-e-upscale).
     */
    public function withAIUpscale(bool $aiUpscale): self
    {
        $obj = clone $this;
        $obj->aiUpscale = $aiUpscale;

        return $obj;
    }

    /**
     * Generates a variation of an image using AI. This produces a new image with slight variations from the original,
     * such as changes in color, texture, and other visual elements, while preserving the structure and essence of the original image. Not supported inside overlay.
     * See [AI Generate Variations](https://imagekit.io/docs/ai-transformations#generate-variations-of-an-image-e-genvar).
     */
    public function withAIVariation(bool $aiVariation): self
    {
        $obj = clone $this;
        $obj->aiVariation = $aiVariation;

        return $obj;
    }

    /**
     * Specifies the aspect ratio for the output, e.g., "ar-4-3". Typically used with either width or height (but not both).
     * For example: aspectRatio = `4:3`, `4_3`, or an expression like `iar_div_2`.
     * See [Image resize and crop – Aspect ratio](https://imagekit.io/docs/image-resize-and-crop#aspect-ratio---ar).
     */
    public function withAspectRatio(float|string $aspectRatio): self
    {
        $obj = clone $this;
        $obj->aspectRatio = $aspectRatio;

        return $obj;
    }

    /**
     * Specifies the audio codec, e.g., `aac`, `opus`, or `none`. See [Audio codec](https://imagekit.io/docs/video-optimization#audio-codec---ac).
     *
     * @param AudioCodec|value-of<AudioCodec> $audioCodec
     */
    public function withAudioCodec(AudioCodec|string $audioCodec): self
    {
        $obj = clone $this;
        $obj->audioCodec = $audioCodec instanceof AudioCodec ? $audioCodec->value : $audioCodec;

        return $obj;
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
        $obj = clone $this;
        $obj->background = $background;

        return $obj;
    }

    /**
     * Specifies the Gaussian blur level. Accepts an integer value between 1 and 100, or an expression like `bl-10`.
     * See [Blur](https://imagekit.io/docs/effects-and-enhancements#blur---bl).
     */
    public function withBlur(float $blur): self
    {
        $obj = clone $this;
        $obj->blur = $blur;

        return $obj;
    }

    /**
     * Adds a border to the output media. Accepts a string in the format `<border-width>_<hex-code>`
     * (e.g., `5_FFF000` for a 5px yellow border), or an expression like `ih_div_20_FF00FF`.
     * See [Border](https://imagekit.io/docs/effects-and-enhancements#border---b).
     */
    public function withBorder(string $border): self
    {
        $obj = clone $this;
        $obj->border = $border;

        return $obj;
    }

    /**
     * Indicates whether the output image should retain the original color profile.
     * See [Color profile](https://imagekit.io/docs/image-optimization#color-profile---cp).
     */
    public function withColorProfile(bool $colorProfile): self
    {
        $obj = clone $this;
        $obj->colorProfile = $colorProfile;

        return $obj;
    }

    /**
     * Automatically enhances the contrast of an image (contrast stretch).
     * See [Contrast Stretch](https://imagekit.io/docs/effects-and-enhancements#contrast-stretch---e-contrast).
     */
    public function withContrastStretch(bool $contrastStretch): self
    {
        $obj = clone $this;
        $obj->contrastStretch = $contrastStretch;

        return $obj;
    }

    /**
     * Crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @param Crop|value-of<Crop> $crop
     */
    public function withCrop(Crop|string $crop): self
    {
        $obj = clone $this;
        $obj->crop = $crop instanceof Crop ? $crop->value : $crop;

        return $obj;
    }

    /**
     * Additional crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
     *
     * @param CropMode|value-of<CropMode> $cropMode
     */
    public function withCropMode(CropMode|string $cropMode): self
    {
        $obj = clone $this;
        $obj->cropMode = $cropMode instanceof CropMode ? $cropMode->value : $cropMode;

        return $obj;
    }

    /**
     * Specifies a fallback image if the resource is not found, e.g., a URL or file path.
     * See [Default image](https://imagekit.io/docs/image-transformation#default-image---di).
     */
    public function withDefaultImage(string $defaultImage): self
    {
        $obj = clone $this;
        $obj->defaultImage = $defaultImage;

        return $obj;
    }

    /**
     * Accepts values between 0.1 and 5, or `auto` for automatic device pixel ratio (DPR) calculation.
     * See [DPR](https://imagekit.io/docs/image-resize-and-crop#dpr---dpr).
     */
    public function withDpr(float $dpr): self
    {
        $obj = clone $this;
        $obj->dpr = $dpr;

        return $obj;
    }

    /**
     * Specifies the duration (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to indicate the length from the start offset. Arithmetic expressions are supported.
     * See [Trim videos – Duration](https://imagekit.io/docs/trim-videos#duration---du).
     */
    public function withDuration(float|string $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
     * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
     */
    public function withEndOffset(float|string $endOffset): self
    {
        $obj = clone $this;
        $obj->endOffset = $endOffset;

        return $obj;
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
        $obj = clone $this;
        $obj->flip = $flip instanceof Flip ? $flip->value : $flip;

        return $obj;
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
        $obj = clone $this;
        $obj->focus = $focus;

        return $obj;
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
        $obj = clone $this;
        $obj->format = $format instanceof Format ? $format->value : $format;

        return $obj;
    }

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    public function withGradient(bool|string $gradient): self
    {
        $obj = clone $this;
        $obj->gradient = $gradient;

        return $obj;
    }

    /**
     * Enables a grayscale effect for images. See [Grayscale](https://imagekit.io/docs/effects-and-enhancements#grayscale---e-grayscale).
     */
    public function withGrayscale(bool $grayscale): self
    {
        $obj = clone $this;
        $obj->grayscale = $grayscale;

        return $obj;
    }

    /**
     * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
     * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
     * Height transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#height---h) · [Videos](https://imagekit.io/docs/video-resize-and-crop#height---h).
     */
    public function withHeight(float|string $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Specifies whether the output image (in JPEG or PNG) should be compressed losslessly.
     * See [Lossless compression](https://imagekit.io/docs/image-optimization#lossless-webp-and-png---lo).
     */
    public function withLossless(bool $lossless): self
    {
        $obj = clone $this;
        $obj->lossless = $lossless;

        return $obj;
    }

    /**
     * By default, ImageKit removes all metadata during automatic image compression.
     * Set this to true to preserve metadata.
     * See [Image metadata](https://imagekit.io/docs/image-optimization#image-metadata---md).
     */
    public function withMetadata(bool $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Named transformation reference. See [Named transformations](https://imagekit.io/docs/transformations#named-transformations).
     */
    public function withNamed(string $named): self
    {
        $obj = clone $this;
        $obj->named = $named;

        return $obj;
    }

    /**
     * Specifies the opacity level of the output image. See [Opacity](https://imagekit.io/docs/effects-and-enhancements#opacity---o).
     */
    public function withOpacity(float $opacity): self
    {
        $obj = clone $this;
        $obj->opacity = $opacity;

        return $obj;
    }

    /**
     * If set to true, serves the original file without applying any transformations.
     * See [Deliver original file as-is](https://imagekit.io/docs/core-delivery-features#deliver-original-file-as-is---orig-true).
     */
    public function withOriginal(bool $original): self
    {
        $obj = clone $this;
        $obj->original = $original;

        return $obj;
    }

    /**
     * Specifies an overlay to be applied on the parent image or video.
     * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
     * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
     */
    public function withOverlay(
        TextOverlay|ImageOverlay|VideoOverlay|SubtitleOverlay|SolidColorOverlay $overlay,
    ): self {
        $obj = clone $this;
        $obj->overlay = $overlay;

        return $obj;
    }

    /**
     * Extracts a specific page or frame from multi-page or layered files (PDF, PSD, AI).
     * For example, specify by number (e.g., `2`), a range (e.g., `3-4` for the 2nd and 3rd layers),
     * or by name (e.g., `name-layer-4` for a PSD layer).
     * See [Thumbnail extraction](https://imagekit.io/docs/vector-and-animated-images#get-thumbnail-from-psd-pdf-ai-eps-and-animated-files).
     */
    public function withPage(float|string $page): self
    {
        $obj = clone $this;
        $obj->page = $page;

        return $obj;
    }

    /**
     * Specifies whether the output JPEG image should be rendered progressively. Progressive loading begins with a low-quality,
     * pixelated version of the full image, which gradually improves to provide a faster perceived load time.
     * See [Progressive images](https://imagekit.io/docs/image-optimization#progressive-image---pr).
     */
    public function withProgressive(bool $progressive): self
    {
        $obj = clone $this;
        $obj->progressive = $progressive;

        return $obj;
    }

    /**
     * Specifies the quality of the output image for lossy formats such as JPEG, WebP, and AVIF.
     * A higher quality value results in a larger file size with better quality, while a lower value produces a smaller file size with reduced quality.
     * See [Quality](https://imagekit.io/docs/image-optimization#quality---q).
     */
    public function withQuality(float $quality): self
    {
        $obj = clone $this;
        $obj->quality = $quality;

        return $obj;
    }

    /**
     * Specifies the corner radius for rounded corners (e.g., 20) or `max` for circular or oval shape.
     * See [Radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     */
    public function withRadius(float|string $radius): self
    {
        $obj = clone $this;
        $obj->radius = $radius;

        return $obj;
    }

    /**
     * Pass any transformation not directly supported by the SDK.
     * This transformation string is appended to the URL as provided.
     */
    public function withRaw(string $raw): self
    {
        $obj = clone $this;
        $obj->raw = $raw;

        return $obj;
    }

    /**
     * Specifies the rotation angle in degrees. Positive values rotate the image clockwise; you can also use, for example, `N40` for counterclockwise rotation
     * or `auto` to use the orientation specified in the image's EXIF data.
     * For videos, only the following values are supported: 0, 90, 180, 270, or 360.
     * See [Rotate](https://imagekit.io/docs/effects-and-enhancements#rotate---rt).
     */
    public function withRotation(float|string $rotation): self
    {
        $obj = clone $this;
        $obj->rotation = $rotation;

        return $obj;
    }

    /**
     * Adds a shadow beneath solid objects in an image with a transparent background.
     * For AI-based drop shadows, refer to aiDropShadow.
     * Pass `true` for a default shadow, or provide a string for a custom shadow.
     * See [Shadow](https://imagekit.io/docs/effects-and-enhancements#shadow---e-shadow).
     */
    public function withShadow(bool|string $shadow): self
    {
        $obj = clone $this;
        $obj->shadow = $shadow;

        return $obj;
    }

    /**
     * Sharpens the input image, highlighting edges and finer details.
     * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
     * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
     */
    public function withSharpen(bool|float $sharpen): self
    {
        $obj = clone $this;
        $obj->sharpen = $sharpen;

        return $obj;
    }

    /**
     * Specifies the start offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
     * Arithmetic expressions are also supported.
     * See [Trim videos – Start offset](https://imagekit.io/docs/trim-videos#start-offset---so).
     */
    public function withStartOffset(float|string $startOffset): self
    {
        $obj = clone $this;
        $obj->startOffset = $startOffset;

        return $obj;
    }

    /**
     * An array of resolutions for adaptive bitrate streaming, e.g., [`240`, `360`, `480`, `720`, `1080`].
     * See [Adaptive Bitrate Streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
     *
     * @param list<StreamingResolution|value-of<StreamingResolution>> $streamingResolutions
     */
    public function withStreamingResolutions(array $streamingResolutions): self
    {
        $obj = clone $this;
        $obj->streamingResolutions = array_map(fn ($v) => $v instanceof StreamingResolution ? $v->value : $v, $streamingResolutions);

        return $obj;
    }

    /**
     * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
     * leaving only the central object in the output image.
     * See [Trim edges](https://imagekit.io/docs/effects-and-enhancements#trim-edges---t).
     */
    public function withTrim(bool|float $trim): self
    {
        $obj = clone $this;
        $obj->trim = $trim;

        return $obj;
    }

    /**
     * Applies Unsharp Masking (USM), an image sharpening technique.
     * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
     * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
     */
    public function withUnsharpMask(bool|string $unsharpMask): self
    {
        $obj = clone $this;
        $obj->unsharpMask = $unsharpMask;

        return $obj;
    }

    /**
     * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`. See [Video codec](https://imagekit.io/docs/video-optimization#video-codec---vc).
     *
     * @param VideoCodec|value-of<VideoCodec> $videoCodec
     */
    public function withVideoCodec(VideoCodec|string $videoCodec): self
    {
        $obj = clone $this;
        $obj->videoCodec = $videoCodec instanceof VideoCodec ? $videoCodec->value : $videoCodec;

        return $obj;
    }

    /**
     * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
     * You can also supply arithmetic expressions (e.g., `iw_div_2`).
     * Width transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#width---w) · [Videos](https://imagekit.io/docs/video-resize-and-crop#width---w).
     */
    public function withWidth(float|string $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }

    /**
     * Focus using cropped image coordinates - X coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withX(float|string $x): self
    {
        $obj = clone $this;
        $obj->x = $x;

        return $obj;
    }

    /**
     * Focus using cropped image coordinates - X center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withXCenter(float|string $xCenter): self
    {
        $obj = clone $this;
        $obj->xCenter = $xCenter;

        return $obj;
    }

    /**
     * Focus using cropped image coordinates - Y coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withY(float|string $y): self
    {
        $obj = clone $this;
        $obj->y = $y;

        return $obj;
    }

    /**
     * Focus using cropped image coordinates - Y center coordinate. See [Focus using cropped coordinates](https://imagekit.io/docs/image-resize-and-crop#example---focus-using-cropped-image-coordinates).
     */
    public function withYCenter(float|string $yCenter): self
    {
        $obj = clone $this;
        $obj->yCenter = $yCenter;

        return $obj;
    }

    /**
     * Accepts a numeric value that determines how much to zoom in or out of the cropped area.
     * It should be used in conjunction with fo-face or fo-<object_name>.
     * See [Zoom](https://imagekit.io/docs/image-resize-and-crop#zoom---z).
     */
    public function withZoom(float $zoom): self
    {
        $obj = clone $this;
        $obj->zoom = $zoom;

        return $obj;
    }
}
