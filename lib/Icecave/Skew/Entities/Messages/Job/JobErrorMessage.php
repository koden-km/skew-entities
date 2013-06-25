<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobErrorMessage extends AbstractJobMessageFromProcessor
{
    use ReasonTrait;
    use RetryTrait;

    /**
     * @param string  $reason The reason the job failed.
     * @param boolean $retry  True if the job is allowed to be retried.
     */
    public function __construct($reason, $retry = false)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setReason($reason);
        $this->setRetry($retry);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.error';
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobErrorMessage($this);
    }

    private $typeCheck;
}
