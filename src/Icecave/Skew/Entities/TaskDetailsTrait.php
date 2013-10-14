<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

trait TaskDetailsTrait
{
    /**
     * Fetch the name of the task to be executed.
     *
     * @return string The name of the task to be executed.
     */
    public function task()
    {
        return $this->task;
    }

    /**
     * Set the name of the task to be executed.
     *
     * @param string $task The name of the task to be executed.
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * Fetch the task priority.
     *
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
     * Set the task priority.
     *
     * @param Priority $priority The task priority.
     */
    public function setPriority(Priority $priority)
    {
        $this->priority = $priority;
    }

    /**
     * Fetch the task payload.
     *
     * The payload is an opaque data structure passed to the task handler upon execution.
     *
     * @return mixed The task payload.
     */
    public function payload()
    {
        return $this->payload;
    }

    /**
     * Set the task payload.
     *
     * The payload is an opaque data structure passed to the task handler upon execution.
     *
     * @param mixed $payload The task payload.
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Fetch the task tags.
     *
     * Tags are arbitrary strings recorded against jobs that can be used to tracking or statistical aggregation.
     *
     * @return Set<string> The task tags.
     */
    public function tags()
    {
        if (null === $this->tags) {
            $this->tags = new Set;
        }

        return $this->tags;
    }

    /**
     * Set the task tags.
     *
     * Tags are arbitrary strings recorded against jobs that can be used to tracking or statistical aggregation.
     *
     * @param mixed<string> $tags Arbitrary string tags.
     */
    public function setTags($tags)
    {
        $t = $this->tags();
        $t->clear();
        $t->addMany($tags);
    }

    /**
     * Copy the elements from another set of task details.
     *
     * @param TaskDetailsInterface $taskDetails The task details to copy.
     */
    public function copyTaskDetails(TaskDetailsInterface $taskDetails)
    {
        $this->setTask($taskDetails->task());
        $this->setPriority($taskDetails->priority());
        $this->setPayload($taskDetails->payload());
        $this->setTags($taskDetails->tags());
    }

    private $priority;
    private $task;
    private $tags;
    private $payload;
}
