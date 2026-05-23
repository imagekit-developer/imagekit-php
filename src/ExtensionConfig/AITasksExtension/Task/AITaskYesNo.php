<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig\AITasksExtension\Task;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo;
use ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown;
use ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnYes;

/**
 * @phpstan-import-type OnNoShape from \ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnNo
 * @phpstan-import-type OnUnknownShape from \ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown
 * @phpstan-import-type OnYesShape from \ImageKit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnYes
 *
 * @phpstan-type AITaskYesNoShape = array{
 *   instruction: string,
 *   type: 'yes_no',
 *   onNo?: null|OnNo|OnNoShape,
 *   onUnknown?: null|OnUnknown|OnUnknownShape,
 *   onYes?: null|OnYes|OnYesShape,
 * }
 */
final class AITaskYesNo implements BaseModel
{
    /** @use SdkModel<AITaskYesNoShape> */
    use SdkModel;

    /**
     * Task type that asks a yes/no question and executes actions based on the answer.
     *
     * @var 'yes_no' $type
     */
    #[Required]
    public string $type = 'yes_no';

    /**
     * The yes/no question for the AI to answer about the image.
     */
    #[Required]
    public string $instruction;

    /**
     * Actions to execute if the AI answers no.
     */
    #[Optional('on_no')]
    public ?OnNo $onNo;

    /**
     * Actions to execute if the AI cannot determine the answer.
     */
    #[Optional('on_unknown')]
    public ?OnUnknown $onUnknown;

    /**
     * Actions to execute if the AI answers yes.
     */
    #[Optional('on_yes')]
    public ?OnYes $onYes;

    /**
     * `new AITaskYesNo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AITaskYesNo::with(instruction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AITaskYesNo)->withInstruction(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param OnNo|OnNoShape|null $onNo
     * @param OnUnknown|OnUnknownShape|null $onUnknown
     * @param OnYes|OnYesShape|null $onYes
     */
    public static function with(
        string $instruction,
        OnNo|array|null $onNo = null,
        OnUnknown|array|null $onUnknown = null,
        OnYes|array|null $onYes = null,
    ): self {
        $self = new self;

        $self['instruction'] = $instruction;

        null !== $onNo && $self['onNo'] = $onNo;
        null !== $onUnknown && $self['onUnknown'] = $onUnknown;
        null !== $onYes && $self['onYes'] = $onYes;

        return $self;
    }

    /**
     * The yes/no question for the AI to answer about the image.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * Task type that asks a yes/no question and executes actions based on the answer.
     *
     * @param 'yes_no' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Actions to execute if the AI answers no.
     *
     * @param OnNo|OnNoShape $onNo
     */
    public function withOnNo(OnNo|array $onNo): self
    {
        $self = clone $this;
        $self['onNo'] = $onNo;

        return $self;
    }

    /**
     * Actions to execute if the AI cannot determine the answer.
     *
     * @param OnUnknown|OnUnknownShape $onUnknown
     */
    public function withOnUnknown(OnUnknown|array $onUnknown): self
    {
        $self = clone $this;
        $self['onUnknown'] = $onUnknown;

        return $self;
    }

    /**
     * Actions to execute if the AI answers yes.
     *
     * @param OnYes|OnYesShape $onYes
     */
    public function withOnYes(OnYes|array $onYes): self
    {
        $self = clone $this;
        $self['onYes'] = $onYes;

        return $self;
    }
}
