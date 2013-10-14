<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

interface TaskDetailsInterface
{
    /**
     * Fetch the name of the task to be executed.
     *
     * @return string The name of the task to be executed.
     */
    public function task();

    /**
     * Fetch the task priority.
     *
     * @return Priority The task priority.
     */
    public function priority();

    /**
     * Fetch the task payload.
     *
     * The payload is an opaque data structure passed to the task handler upon execution.
     *
     * @return mixed The task payload.
     */
    public function payload();

    /**
     * Fetch the task tags.
     *
     * Tags are arbitrary strings recorded against jobs that can be used to tracking or statistical aggregation.
     *
     * @return Set<string> The task tags.
     */
    public function tags();

    /**
     * Copy the elements from another set of task details.
     *
     * @param TaskDetailsInterface $taskDetails The task details to copy.
     */
    public function copyTaskDetails(TaskDetailsInterface $taskDetails);
}
