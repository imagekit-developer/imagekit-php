<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadResponse;

use ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AIAutoDescription;
use ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AwsAutoTagging;
use ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\GoogleAutoTagging;
use ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\RemoveBg;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
 *
 * `success`: The extension has been successfully applied.
 * `failed`: The extension has failed and will not be retried.
 * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
 *
 * If no extension was requested, then this parameter is not returned.
 *
 * @phpstan-type extension_status = array{
 *   aiAutoDescription?: value-of<AIAutoDescription>,
 *   awsAutoTagging?: value-of<AwsAutoTagging>,
 *   googleAutoTagging?: value-of<GoogleAutoTagging>,
 *   removeBg?: value-of<RemoveBg>,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    /** @use SdkModel<extension_status> */
    use SdkModel;

    /** @var value-of<AIAutoDescription>|null $aiAutoDescription */
    #[Api('ai-auto-description', enum: AIAutoDescription::class, optional: true)]
    public ?string $aiAutoDescription;

    /** @var value-of<AwsAutoTagging>|null $awsAutoTagging */
    #[Api('aws-auto-tagging', enum: AwsAutoTagging::class, optional: true)]
    public ?string $awsAutoTagging;

    /** @var value-of<GoogleAutoTagging>|null $googleAutoTagging */
    #[Api('google-auto-tagging', enum: GoogleAutoTagging::class, optional: true)]
    public ?string $googleAutoTagging;

    /** @var value-of<RemoveBg>|null $removeBg */
    #[Api('remove-bg', enum: RemoveBg::class, optional: true)]
    public ?string $removeBg;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AIAutoDescription|value-of<AIAutoDescription> $aiAutoDescription
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $awsAutoTagging
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $googleAutoTagging
     * @param RemoveBg|value-of<RemoveBg> $removeBg
     */
    public static function with(
        AIAutoDescription|string|null $aiAutoDescription = null,
        AwsAutoTagging|string|null $awsAutoTagging = null,
        GoogleAutoTagging|string|null $googleAutoTagging = null,
        RemoveBg|string|null $removeBg = null,
    ): self {
        $obj = new self;

        null !== $aiAutoDescription && $obj->aiAutoDescription = $aiAutoDescription instanceof AIAutoDescription ? $aiAutoDescription->value : $aiAutoDescription;
        null !== $awsAutoTagging && $obj->awsAutoTagging = $awsAutoTagging instanceof AwsAutoTagging ? $awsAutoTagging->value : $awsAutoTagging;
        null !== $googleAutoTagging && $obj->googleAutoTagging = $googleAutoTagging instanceof GoogleAutoTagging ? $googleAutoTagging->value : $googleAutoTagging;
        null !== $removeBg && $obj->removeBg = $removeBg instanceof RemoveBg ? $removeBg->value : $removeBg;

        return $obj;
    }

    /**
     * @param AIAutoDescription|value-of<AIAutoDescription> $aiAutoDescription
     */
    public function withAIAutoDescription(
        AIAutoDescription|string $aiAutoDescription
    ): self {
        $obj = clone $this;
        $obj->aiAutoDescription = $aiAutoDescription instanceof AIAutoDescription ? $aiAutoDescription->value : $aiAutoDescription;

        return $obj;
    }

    /**
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $awsAutoTagging
     */
    public function withAwsAutoTagging(
        AwsAutoTagging|string $awsAutoTagging
    ): self {
        $obj = clone $this;
        $obj->awsAutoTagging = $awsAutoTagging instanceof AwsAutoTagging ? $awsAutoTagging->value : $awsAutoTagging;

        return $obj;
    }

    /**
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $googleAutoTagging
     */
    public function withGoogleAutoTagging(
        GoogleAutoTagging|string $googleAutoTagging
    ): self {
        $obj = clone $this;
        $obj->googleAutoTagging = $googleAutoTagging instanceof GoogleAutoTagging ? $googleAutoTagging->value : $googleAutoTagging;

        return $obj;
    }

    /**
     * @param RemoveBg|value-of<RemoveBg> $removeBg
     */
    public function withRemoveBg(RemoveBg|string $removeBg): self
    {
        $obj = clone $this;
        $obj->removeBg = $removeBg instanceof RemoveBg ? $removeBg->value : $removeBg;

        return $obj;
    }
}
