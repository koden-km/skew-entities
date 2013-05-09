<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobErrorMessage extends AbstractJobMessageFromProcessor
{
    use ReasonTrait;

    /**
     * @param string  $reason     The reason the job failed.
     * @param boolean $reschedule True if the job is allowed to be re-scheduled.
     */
    public function __construct($reason, $reschedule = false)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setReason($reason);
        $this->setReschedule($reschedule);

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
     * @return boolean True if the job is allowed to be re-scheduled.
     */
    public function reschedule()
    {
        $this->typeCheck->reschedule(func_get_args());

        return $this->reschedule;
    }

    /**
     * @param boolean $reschedule True if the job is allowed to be re-scheduled.
     */
    public function setReschedule($reschedule)
    {
        $this->typeCheck->setReschedule(func_get_args());

        $this->reschedule = $reschedule;
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
    private $reschedule;
}
