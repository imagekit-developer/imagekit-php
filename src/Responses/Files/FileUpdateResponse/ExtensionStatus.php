<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUpdateResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus\AIAutoDescription;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus\AwsAutoTagging;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus\GoogleAutoTagging;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus\RemoveBg;

/**
 * @phpstan-type extension_status_alias = array{
 *   aiAutoDescription?: AIAutoDescription::*,
 *   awsAutoTagging?: AwsAutoTagging::*,
 *   googleAutoTagging?: GoogleAutoTagging::*,
 *   removeBg?: RemoveBg::*,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    use SdkModel;

    /** @var null|AIAutoDescription::* $aiAutoDescription */
    #[Api('ai-auto-description', enum: AIAutoDescription::class, optional: true)]
    public ?string $aiAutoDescription;

    /** @var null|AwsAutoTagging::* $awsAutoTagging */
    #[Api('aws-auto-tagging', enum: AwsAutoTagging::class, optional: true)]
    public ?string $awsAutoTagging;

    /** @var null|GoogleAutoTagging::* $googleAutoTagging */
    #[Api('google-auto-tagging', enum: GoogleAutoTagging::class, optional: true)]
    public ?string $googleAutoTagging;

    /** @var null|RemoveBg::* $removeBg */
    #[Api('remove-bg', enum: RemoveBg::class, optional: true)]
    public ?string $removeBg;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|AIAutoDescription::* $aiAutoDescription
     * @param null|AwsAutoTagging::* $awsAutoTagging
     * @param null|GoogleAutoTagging::* $googleAutoTagging
     * @param null|RemoveBg::* $removeBg
     */
    public static function with(
        ?string $aiAutoDescription = null,
        ?string $awsAutoTagging = null,
        ?string $googleAutoTagging = null,
        ?string $removeBg = null,
    ): self {
        $obj = new self;

        null !== $aiAutoDescription && $obj->aiAutoDescription = $aiAutoDescription;
        null !== $awsAutoTagging && $obj->awsAutoTagging = $awsAutoTagging;
        null !== $googleAutoTagging && $obj->googleAutoTagging = $googleAutoTagging;
        null !== $removeBg && $obj->removeBg = $removeBg;

        return $obj;
    }

    /**
     * @param AIAutoDescription::* $aiAutoDescription
     */
    public function withAIAutoDescription(string $aiAutoDescription): self
    {
        $obj = clone $this;
        $obj->aiAutoDescription = $aiAutoDescription;

        return $obj;
    }

    /**
     * @param AwsAutoTagging::* $awsAutoTagging
     */
    public function withAwsAutoTagging(string $awsAutoTagging): self
    {
        $obj = clone $this;
        $obj->awsAutoTagging = $awsAutoTagging;

        return $obj;
    }

    /**
     * @param GoogleAutoTagging::* $googleAutoTagging
     */
    public function withGoogleAutoTagging(string $googleAutoTagging): self
    {
        $obj = clone $this;
        $obj->googleAutoTagging = $googleAutoTagging;

        return $obj;
    }

    /**
     * @param RemoveBg::* $removeBg
     */
    public function withRemoveBg(string $removeBg): self
    {
        $obj = clone $this;
        $obj->removeBg = $removeBg;

        return $obj;
    }
}
