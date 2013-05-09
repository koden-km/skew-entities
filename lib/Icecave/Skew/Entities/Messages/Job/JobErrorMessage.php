<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;

class JobErrorMessage extends AbstractJobMessageFromProcessor
{
    use ReasonTrait;

    public function __construct($reason, $reschedule = false)
    {
        $this->setReason($reason);
        $this->setReschedule($reschedule);
    }

    public function type()
    {
        return 'job.error';
    }

    public function reschedule()
    {
        return $this->reschedule;
    }

    public function setReschedule($reschedule)
    {
        $this->reschedule = $reschedule;
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobErrorMessage($this);
    }

    private $reschedule;
}
