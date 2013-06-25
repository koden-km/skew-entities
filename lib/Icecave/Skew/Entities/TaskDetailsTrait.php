<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

trait TaskDetailsTrait
{
    /**
     * @return Priority The task priority.
     */
    public function priority()
    {
        if (null === $this->priority) {
            $this->setPriority(Priority::NORMAL());
        }

        return $this->priority;
    }

    /**
     * @param Priority $priority The task priority.
     */
    public function setPriority(Priority $priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string The task name to execute.
     */
    public function task()
    {
        return $this->task;
    }

    /**
     * @param string $task The task name to execute.
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed The payload to send to the task.
     */
    public function payload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload The payload to send to the task.
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return Set<string> Arbitrary string tags.
     */
    public function tags()
    {
        if (null === $this->tags) {
            $this->tags = new Set;
        }

        return $this->tags;
    }

    /**
     * @param mixed<string> $tags Arbitrary string tags.
     */
    public function setTags($tags)
    {
        $t = $this->tags();
        $t->clear();
        $t->unionInPlace($tags);
    }

    private $priority;
    private $task;
    private $tags;
    private $payload;
}
