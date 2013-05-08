<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageWithWorker
{
    use ReasonTrait;

    public function __construct($reason, $reschedule = false)
    {
        $this->setReason($reason);
        $this->setReschedule($reschedule);
    }

    public function reschedule()
    {
        return $this->reschedule;
    }

    public function setReschedule($reschedule)
    {
        $this->reschedule = $reschedule;
    }

    private $reschedule;
}
