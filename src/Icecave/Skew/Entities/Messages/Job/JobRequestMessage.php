<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\Flow\ClientMessageInterface;
use Icecave\Skew\Entities\Messages\Flow\DaemonToProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TaskDetailsInterface;
use Icecave\Skew\Entities\TaskDetailsTrait;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobRequestMessage extends AbstractJobMessage implements
    TaskDetailsInterface,
    ClientMessageInterface,
    DaemonToProcessorMessageInterface
{
    use TaskDetailsTrait;

    /**
     * @param string $jobId The job ID.
     * @param string $task  The task name to execute.
     */
    public function __construct($jobId, $task)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        parent::__construct();

        $this->setJobId($jobId);
        $this->setTask($task);
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.request';
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobRequestMessage($this);
    }

    private $typeCheck;
}
