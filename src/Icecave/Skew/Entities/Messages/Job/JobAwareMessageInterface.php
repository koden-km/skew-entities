<?php
namespace Icecave\Skew\Entities\Messages\Job;

interface JobAwareMessageInterface
{
    /**
     * @return string The job ID.
     */
    public function jobId();

    /**
     * @param string $jobId The job ID.
     */
    public function setJobId($jobId);
}
