<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobRejectMessage extends AbstractJobMessageFromProcessor
{
    use ReasonTrait;

    /**
     * @param string $reason The reason the job was rejected.
     */
    public function __construct($reason)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setReason($reason);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.reject';
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobRejectMessage($this);
    }

    private $typeCheck;
}
