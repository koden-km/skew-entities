<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\ClientMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;

class JobRequestMessage extends AbstractJobMessage implements ClientMessageInterface
{
    public function __construct($task)
    {
        $this->setTask($task);

        $this->tags = new Set;

        parent::__construct();
    }

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

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobRequestMessage($this);
    }

    private $task;
    private $tags;
    private $payload;
}
