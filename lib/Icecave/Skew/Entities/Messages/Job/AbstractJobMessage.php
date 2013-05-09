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
    public function jobId()
    {
        $this->typeCheck->jobId(func_get_args());

        return $this->jobId;
    }

    /**
     * @param string $jobId The job ID.
     */
    public function setJobId($jobId)
    {
        $this->typeCheck->setJobId(func_get_args());

        $this->jobId = $jobId;
    }

    private $typeCheck;
    private $jobId;
}
