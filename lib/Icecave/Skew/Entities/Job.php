<?php
namespace Icecave\Skew\Entities;

use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Job implements JobInterface
{
    use JobDetailsTrait;

    /**
     * @param string $id   The job ID.
     * @param string $task The task name to execute.
     */
    public function __construct($id, $task)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setId($id);
        $this->setTask($task);
    }

    /**
     * @param JobRequestMessage $request A job request message describing the job to create.
     *
     * @return Job
     */
    public static function fromRequest(JobRequestMessage $request)
    {
        TypeCheck::get(__CLASS__)->fromRequest(func_get_args());

        $job = new static($request->job(), $request->task());
        $job->setPayload($request->payload());
        $job->setTags($request->tags());

        return $job;
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

    private $typeCheck;
    private $id;
}
