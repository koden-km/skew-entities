<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\AbstractMessage;

class AbstractJobMessage extends AbstractMessage
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
