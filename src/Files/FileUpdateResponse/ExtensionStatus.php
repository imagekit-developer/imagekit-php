<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUpdateResponse\ExtensionStatus\AIAutoDescription;
use ImageKit\Files\FileUpdateResponse\ExtensionStatus\AwsAutoTagging;
use ImageKit\Files\FileUpdateResponse\ExtensionStatus\GoogleAutoTagging;
use ImageKit\Files\FileUpdateResponse\ExtensionStatus\RemoveBg;

/**
 * @phpstan-type ExtensionStatusShape = array{
 *   aiAutoDescription?: value-of<AIAutoDescription>,
 *   awsAutoTagging?: value-of<AwsAutoTagging>,
 *   googleAutoTagging?: value-of<GoogleAutoTagging>,
 *   removeBg?: value-of<RemoveBg>,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    /** @use SdkModel<ExtensionStatusShape> */
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

        null !== $aiAutoDescription && $obj['aiAutoDescription'] = $aiAutoDescription;
        null !== $awsAutoTagging && $obj['awsAutoTagging'] = $awsAutoTagging;
        null !== $googleAutoTagging && $obj['googleAutoTagging'] = $googleAutoTagging;
        null !== $removeBg && $obj['removeBg'] = $removeBg;

        return $obj;
    }

    /**
     * @param AIAutoDescription|value-of<AIAutoDescription> $aiAutoDescription
     */
    public function withAIAutoDescription(
        AIAutoDescription|string $aiAutoDescription
    ): self {
        $obj = clone $this;
        $obj['aiAutoDescription'] = $aiAutoDescription;

        return $obj;
    }

    /**
     * @param AwsAutoTagging|value-of<AwsAutoTagging> $awsAutoTagging
     */
    public function withAwsAutoTagging(
        AwsAutoTagging|string $awsAutoTagging
    ): self {
        $obj = clone $this;
        $obj['awsAutoTagging'] = $awsAutoTagging;

        return $obj;
    }

    /**
     * @param GoogleAutoTagging|value-of<GoogleAutoTagging> $googleAutoTagging
     */
    public function withGoogleAutoTagging(
        GoogleAutoTagging|string $googleAutoTagging
    ): self {
        $obj = clone $this;
        $obj['googleAutoTagging'] = $googleAutoTagging;

        return $obj;
    }

    /**
     * @param RemoveBg|value-of<RemoveBg> $removeBg
     */
    public function withRemoveBg(RemoveBg|string $removeBg): self
    {
        $obj = clone $this;
        $obj['removeBg'] = $removeBg;

        return $obj;
    }
}
