<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadResponse;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\FileUploadResponse\ExtensionStatus\AIAutoDescription;
use Imagekit\Files\FileUploadResponse\ExtensionStatus\AwsAutoTagging;
use Imagekit\Files\FileUploadResponse\ExtensionStatus\GoogleAutoTagging;
use Imagekit\Files\FileUploadResponse\ExtensionStatus\RemoveBg;

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
 *   aiAutoDescription?: null|AIAutoDescription|value-of<AIAutoDescription>,
 *   awsAutoTagging?: null|AwsAutoTagging|value-of<AwsAutoTagging>,
 *   googleAutoTagging?: null|GoogleAutoTagging|value-of<GoogleAutoTagging>,
 *   removeBg?: null|RemoveBg|value-of<RemoveBg>,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    /** @use SdkModel<ExtensionStatusShape> */
    use SdkModel;

    /** @var value-of<AIAutoDescription>|null $aiAutoDescription */
    #[Optional('ai-auto-description', enum: AIAutoDescription::class)]
    public ?string $aiAutoDescription;

    /** @var value-of<AwsAutoTagging>|null $awsAutoTagging */
    #[Optional('aws-auto-tagging', enum: AwsAutoTagging::class)]
    public ?string $awsAutoTagging;

    /** @var value-of<GoogleAutoTagging>|null $googleAutoTagging */
    #[Optional('google-auto-tagging', enum: GoogleAutoTagging::class)]
    public ?string $googleAutoTagging;

    /** @var value-of<RemoveBg>|null $removeBg */
    #[Optional('remove-bg', enum: RemoveBg::class)]
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
        $self = new self;

        null !== $aiAutoDescription && $self['aiAutoDescription'] = $aiAutoDescription;
        null !== $awsAutoTagging && $self['awsAutoTagging'] = $awsAutoTagging;
        null !== $googleAutoTagging && $self['googleAutoTagging'] = $googleAutoTagging;
        null !== $removeBg && $self['removeBg'] = $removeBg;

        return $self;
    }

    /**
     * @param AIAutoDescription|value-of<AIAutoDescription> $aiAutoDescription
     */
    public function withAIAutoDescription(
        AIAutoDescription|string $aiAutoDescription
    ): self {
        $self = clone $this;
        $self['aiAutoDescription'] = $aiAutoDescription;

        return $self;
    }

    /**
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $awsAutoTagging
     */
    public function withAwsAutoTagging(
        AwsAutoTagging|string $awsAutoTagging
    ): self {
        $self = clone $this;
        $self['awsAutoTagging'] = $awsAutoTagging;

        return $self;
    }

    /**
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $googleAutoTagging
     */
    public function withGoogleAutoTagging(
        GoogleAutoTagging|string $googleAutoTagging
    ): self {
        $self = clone $this;
        $self['googleAutoTagging'] = $googleAutoTagging;

        return $self;
    }

    /**
     * @param RemoveBg|value-of<RemoveBg> $removeBg
     */
    public function withRemoveBg(RemoveBg|string $removeBg): self
    {
        $self = clone $this;
        $self['removeBg'] = $removeBg;

        return $self;
    }
}
