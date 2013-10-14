<?php
namespace Icecave\Skew\Entities;

interface JobInterface
{
    /**
     * Fetch the ID of the job.
     *
     * @return string The ID of the job.
     */
    public function id();

    /**
     * Fetch the task details for the job.
     *
     * @return TaskDetailsInterface The job's task details.
     */
    public function taskDetails();
}
