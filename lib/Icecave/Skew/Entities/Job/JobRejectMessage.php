<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageWithWorker
{
    public function __construct($reason)
    {
        $this->setReason($reason);
        $this->setReschedule($reschedule);
    }

    public function reason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function reschedule()
    {
        return $this->reschedule;
    }

    public function setReschedule($reschedule)
    {
        $this->reschedule = $reschedule;
    }

    private $reason;
    private $reschedule;
}
