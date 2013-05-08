<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\MessageInterface;

class AbstractJobMessage implements MessageInterface
{
    public function job()
    {
        return $this->job;
    }

    public function setJob($job)
    {
        $this->job = $job;
    }

    private $job;
}
