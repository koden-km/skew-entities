<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\MessageInterface;

abstract class AbstractJobMessage implements MessageInterface
{
    public function __construct()
    {

    }

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
