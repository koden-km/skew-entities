<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Job implements JobInterface
{
    /**
     * @param string $id   The job ID.
     * @param string $task The task name to execute.
     */
    public function __construct($id, $task)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->tags = new Set;

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

    /**
     * @return string The task name to execute.
     */
    public function task()
    {
        $this->typeCheck->task(func_get_args());

        return $this->task;
    }

    /**
     * @param string $task The task name to execute.
     */
    public function setTask($task)
    {
        $this->typeCheck->setTask(func_get_args());

        $this->task = $task;
    }

    /**
     * @return mixed The payload to send to the task.
     */
    public function payload()
    {
        $this->typeCheck->payload(func_get_args());

        return $this->payload;
    }

    /**
     * @param mixed $payload The payload to send to the task.
     */
    public function setPayload($payload)
    {
        $this->typeCheck->setPayload(func_get_args());

        $this->payload = $payload;
    }

    /**
     * @return Set<string> Arbitrary string tags.
     */
    public function tags()
    {
        $this->typeCheck->tags(func_get_args());

        return $this->tags;
    }

    /**
     * @param mixed<string> $tags Arbitrary string tags.
     */
    public function setTags($tags)
    {
        $this->typeCheck->setTags(func_get_args());

        $this->tags->clear();
        $this->tags->unionInPlace($tags);
    }

    private $typeCheck;
    private $id;
    private $task;
    private $tags;
    private $payload;
}
