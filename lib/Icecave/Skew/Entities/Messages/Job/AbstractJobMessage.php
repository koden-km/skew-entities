<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\MessageInterface;

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
