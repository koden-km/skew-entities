<?php
namespace Icecave\Skew\Entities;

use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class TaskDetails implements TaskDetailsInterface
{
    use TaskDetailsTrait;

    /**
     * @param string $task The name of the task to be executed.
     */
    public function __construct($task)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setTask($task);
    }

    /**
     * Construct a task details object from a job request.
     *
     * @param JobRequestMessage $request A job request message describing the job to create.
     *
     * @return TaskDetails
     */
    public static function fromRequest(JobRequestMessage $request)
    {
        TypeCheck::get(__CLASS__)->fromRequest(func_get_args());

        $taskDetails = new static($request->task());
        // $taskDetails->copyTaskDetails($request);
        $taskDetails->setPriority($request->priority());
        $taskDetails->setPayload($request->payload());
        $taskDetails->setTags($request->tags());

        return $taskDetails;
    }

    private $typeCheck;
}
