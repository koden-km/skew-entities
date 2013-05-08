<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Collections\Set;

class JobRequestMessage extends AbstractJobMessage implements ClientMessageInterface
{
    public function type()
    {
        return 'job.request';
    }

    public function task()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function tags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags->clear();
        $this->tags->unionInPlace($tags);
    }

    public function payload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobRequestMessage($this);
    }

    private $task;
    private $tags = new Set;
    private $payload;
}
