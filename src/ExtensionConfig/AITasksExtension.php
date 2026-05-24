<?php

declare(strict_types=1);

namespace ImageKit\ExtensionConfig;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionConfig\AITasksExtension\Task;

/**
 * @phpstan-import-type TaskVariants from \ImageKit\ExtensionConfig\AITasksExtension\Task
 * @phpstan-import-type TaskShape from \ImageKit\ExtensionConfig\AITasksExtension\Task
 *
 * @phpstan-type AITasksExtensionShape = array{
 *   name: 'ai-tasks', tasks: list<TaskShape>
 * }
 */
final class AITasksExtension implements BaseModel
{
    /** @use SdkModel<AITasksExtensionShape> */
    use SdkModel;

    /**
     * Specifies the AI tasks extension for automated image analysis using AI models.
     *
     * @var 'ai-tasks' $name
     */
    #[Required]
    public string $name = 'ai-tasks';

    /**
     * Array of task objects defining AI operations to perform on the asset.
     *
     * @var list<TaskVariants> $tasks
     */
    #[Required(list: Task::class)]
    public array $tasks;

    /**
     * `new AITasksExtension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AITasksExtension::with(tasks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AITasksExtension)->withTasks(...)
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
     * @param list<TaskShape> $tasks
     */
    public static function with(array $tasks): self
    {
        $self = new self;

        $self['tasks'] = $tasks;

        return $self;
    }

    /**
     * Specifies the AI tasks extension for automated image analysis using AI models.
     *
     * @param 'ai-tasks' $name
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Array of task objects defining AI operations to perform on the asset.
     *
     * @param list<TaskShape> $tasks
     */
    public function withTasks(array $tasks): self
    {
        $self = clone $this;
        $self['tasks'] = $tasks;

        return $self;
    }
}
