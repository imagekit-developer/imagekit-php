<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionItem\AITasksExtension\Task;

/**
 * @phpstan-import-type TaskVariants from \Imagekit\ExtensionItem\AITasksExtension\Task
 * @phpstan-import-type TaskShape from \Imagekit\ExtensionItem\AITasksExtension\Task
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
