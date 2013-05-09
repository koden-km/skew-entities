<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\ClientMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobRequestMessage extends AbstractJobMessage implements ClientMessageInterface
{
    /**
     * @param string $task The task name to execute.
     */
    public function __construct($task)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setTask($task);
        $this->tags = new Set;

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.request';
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
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobRequestMessage($this);
    }

    private $typeCheck;
    private $task;
    private $tags;
    private $payload;
}
