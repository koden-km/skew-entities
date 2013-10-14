<?php
namespace Icecave\Skew\Entities;

use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Job implements JobInterface
{
    /**
     * @param string               $id          The job ID.
     * @param TaskDetailsInterface $taskDetails The job's task details.
     */
    public function __construct($id, TaskDetailsInterface $taskDetails)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setId($id);
        $this->setTaskDetails($taskDetails);
    }

    /**
     * Create a job from a job request.
     *
     * @param JobRequestMessage $request A job request message describing the job to create.
     *
     * @return Job
     */
    public static function fromRequest(JobRequestMessage $request)
    {
        TypeCheck::get(__CLASS__)->fromRequest(func_get_args());

        return new static(
            $request->jobId(),
            TaskDetails::fromRequest($request)
        );
    }

    /**
     * Fetch the ID of the job.
     *
     * @return string The ID of the job.
     */
    public function id()
    {
        $this->typeCheck->id(func_get_args());

        return $this->id;
    }

    /**
     * Set the ID of the job.
     *
     * @param string $id The ID of the job.
     */
    public function setId($id)
    {
        $this->typeCheck->setId(func_get_args());

        $this->id = $id;
    }

    /**
     * Fetch the task details for the job.
     *
     * @return TaskDetailsInterface The job's task details.
     */
    public function taskDetails()
    {
        $this->typeCheck->taskDetails(func_get_args());

        return $this->taskDetails;
    }

    /**
     * Set the job's task details.
     *
     * @param TaskDetailsInterface $taskDetails The job's task details.
     */
    public function setTaskDetails(TaskDetailsInterface $taskDetails)
    {
        $this->typeCheck->setTaskDetails(func_get_args());

        $this->taskDetails = $taskDetails;
    }

    private $typeCheck;
    private $id;
    private $taskDetails;
}
