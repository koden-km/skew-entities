<?php
namespace Icecave\Skew\Entities;

use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Job implements JobInterface
{
    /**
     * @param string               $id          The job ID.
     * @param TaskDetailsInterface $taskDetails
     */
    public function __construct($id, TaskDetailsInterface $taskDetails)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setId($id);
        $this->setTaskDetails($taskDetails);
    }

    /**
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
     * @return string
     */
    public function id()
    {
        $this->typeCheck->id(func_get_args());

        return $this->id;
    }

    /**
     * @param string $id The job ID.
     */
    public function setId($id)
    {
        $this->typeCheck->setId(func_get_args());

        $this->id = $id;
    }

    /**
     * @return TaskDetailsInterface
     */
    public function taskDetails()
    {
        $this->typeCheck->taskDetails(func_get_args());

        return $this->taskDetails;
    }

    /**
     * @param TaskDetailsInterface $taskDetails
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
