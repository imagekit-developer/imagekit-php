<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV2Response;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\FileUploadV2Response\ExtensionStatus\AwsAutoTagging;
use ImageKit\Responses\Files\FileUploadV2Response\ExtensionStatus\GoogleAutoTagging;
use ImageKit\Responses\Files\FileUploadV2Response\ExtensionStatus\RemoveBg;

/**
 * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
 *
 * `success`: The extension has been successfully applied.
 * `failed`: The extension has failed and will not be retried.
 * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
 *
 * If no extension was requested, then this parameter is not returned.
 *
 * @phpstan-type extension_status_alias = array{
 *   awsAutoTagging?: AwsAutoTagging::*,
 *   googleAutoTagging?: GoogleAutoTagging::*,
 *   removeBg?: RemoveBg::*,
 * }
 */
final class ExtensionStatus implements BaseModel
{
    use Model;

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
     * @param null|AwsAutoTagging::* $awsAutoTagging
     * @param null|GoogleAutoTagging::* $googleAutoTagging
     * @param null|RemoveBg::* $removeBg
     */
    public static function with(
        ?string $awsAutoTagging = null,
        ?string $googleAutoTagging = null,
        ?string $removeBg = null,
    ): self {
        $obj = new self;

        null !== $awsAutoTagging && $obj->awsAutoTagging = $awsAutoTagging;
        null !== $googleAutoTagging && $obj->googleAutoTagging = $googleAutoTagging;
        null !== $removeBg && $obj->removeBg = $removeBg;

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
