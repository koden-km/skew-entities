<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobAcceptMessage extends AbstractJobMessageFromProcessor
{
    use RetryTrait;

    /**
     * @param boolean $retry True if the job is allowed to be retried.
     */
    public function __construct($retry = false)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setRetry($retry);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.accept';
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobAcceptMessage($this);
    }

    private $typeCheck;
}
