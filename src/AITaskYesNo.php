<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AITaskActionShape from \ImageKit\AITaskAction
 *
 * @phpstan-type AITaskYesNoShape = array{
 *   instruction: string,
 *   type: 'yes_no',
 *   onNo?: null|AITaskAction|AITaskActionShape,
 *   onUnknown?: null|AITaskAction|AITaskActionShape,
 *   onYes?: null|AITaskAction|AITaskActionShape,
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
    public ?AITaskAction $onNo;

    /**
     * Actions to execute if the AI cannot determine the answer.
     */
    #[Optional('on_unknown')]
    public ?AITaskAction $onUnknown;

    /**
     * Actions to execute if the AI answers yes.
     */
    #[Optional('on_yes')]
    public ?AITaskAction $onYes;

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
     * @param AITaskAction|AITaskActionShape|null $onNo
     * @param AITaskAction|AITaskActionShape|null $onUnknown
     * @param AITaskAction|AITaskActionShape|null $onYes
     */
    public static function with(
        string $instruction,
        AITaskAction|array|null $onNo = null,
        AITaskAction|array|null $onUnknown = null,
        AITaskAction|array|null $onYes = null,
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
     * @param AITaskAction|AITaskActionShape $onNo
     */
    public function withOnNo(AITaskAction|array $onNo): self
    {
        $self = clone $this;
        $self['onNo'] = $onNo;

        return $self;
    }

    /**
     * Actions to execute if the AI cannot determine the answer.
     *
     * @param AITaskAction|AITaskActionShape $onUnknown
     */
    public function withOnUnknown(AITaskAction|array $onUnknown): self
    {
        $self = clone $this;
        $self['onUnknown'] = $onUnknown;

        return $self;
    }

    /**
     * Actions to execute if the AI answers yes.
     *
     * @param AITaskAction|AITaskActionShape $onYes
     */
    public function withOnYes(AITaskAction|array $onYes): self
    {
        $self = clone $this;
        $self['onYes'] = $onYes;

        return $self;
    }
}
