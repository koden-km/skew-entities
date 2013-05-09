<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

abstract class AbstractJobMessage implements MessageInterface
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());
    }

    /**
     * @return string The job ID.
     */
    public function job()
    {
        $this->typeCheck->job(func_get_args());

        return $this->job;
    }

    /**
     * @param string $job The job ID.
     */
    public function setJob($job)
    {
        $this->typeCheck->setJob(func_get_args());

        $this->job = $job;
    }

    private $typeCheck;
    private $job;
}
