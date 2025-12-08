<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadResponse;

use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AIAutoDescription;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AwsAutoTagging;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\GoogleAutoTagging;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\RemoveBg;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
 *
 * `success`: The extension has been successfully applied.
 * `failed`: The extension has failed and will not be retried.
 * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
 *
 * If no extension was requested, then this parameter is not returned.
 *
 * @phpstan-type ExtensionStatusShape = array{
 *   ai_auto_description?: value-of<AIAutoDescription>|null,
 *   aws_auto_tagging?: value-of<AwsAutoTagging>|null,
 *   google_auto_tagging?: value-of<GoogleAutoTagging>|null,
 *   remove_bg?: value-of<RemoveBg>|null,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    /** @use SdkModel<ExtensionStatusShape> */
    use SdkModel;

    /** @var value-of<AIAutoDescription>|null $ai_auto_description */
    #[Optional('ai-auto-description', enum: AIAutoDescription::class)]
    public ?string $ai_auto_description;

    /** @var value-of<AwsAutoTagging>|null $aws_auto_tagging */
    #[Optional('aws-auto-tagging', enum: AwsAutoTagging::class)]
    public ?string $aws_auto_tagging;

    /** @var value-of<GoogleAutoTagging>|null $google_auto_tagging */
    #[Optional('google-auto-tagging', enum: GoogleAutoTagging::class)]
    public ?string $google_auto_tagging;

    /** @var value-of<RemoveBg>|null $remove_bg */
    #[Optional('remove-bg', enum: RemoveBg::class)]
    public ?string $remove_bg;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AIAutoDescription|value-of<AIAutoDescription> $ai_auto_description
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $aws_auto_tagging
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $google_auto_tagging
     * @param RemoveBg|value-of<RemoveBg> $remove_bg
     */
    public static function with(
        AIAutoDescription|string|null $ai_auto_description = null,
        AwsAutoTagging|string|null $aws_auto_tagging = null,
        GoogleAutoTagging|string|null $google_auto_tagging = null,
        RemoveBg|string|null $remove_bg = null,
    ): self {
        $obj = new self;

        null !== $ai_auto_description && $obj['ai_auto_description'] = $ai_auto_description;
        null !== $aws_auto_tagging && $obj['aws_auto_tagging'] = $aws_auto_tagging;
        null !== $google_auto_tagging && $obj['google_auto_tagging'] = $google_auto_tagging;
        null !== $remove_bg && $obj['remove_bg'] = $remove_bg;

        return $obj;
    }

    /**
     * @param AIAutoDescription|value-of<AIAutoDescription> $aiAutoDescription
     */
    public function withAIAutoDescription(
        AIAutoDescription|string $aiAutoDescription
    ): self {
        $obj = clone $this;
        $obj['ai_auto_description'] = $aiAutoDescription;

        return $obj;
    }

    /**
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $awsAutoTagging
     */
    public function withAwsAutoTagging(
        AwsAutoTagging|string $awsAutoTagging
    ): self {
        $obj = clone $this;
        $obj['aws_auto_tagging'] = $awsAutoTagging;

        return $obj;
    }

    /**
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $googleAutoTagging
     */
    public function withGoogleAutoTagging(
        GoogleAutoTagging|string $googleAutoTagging
    ): self {
        $obj = clone $this;
        $obj['google_auto_tagging'] = $googleAutoTagging;

        return $obj;
    }

    /**
     * @param RemoveBg|value-of<RemoveBg> $removeBg
     */
    public function withRemoveBg(RemoveBg|string $removeBg): self
    {
        $obj = clone $this;
        $obj['remove_bg'] = $removeBg;

        return $obj;
    }
}
