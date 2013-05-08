<?php
namespace Icecave\Skew\Entities\Job;

class JobRejectMessage extends AbstractJobMessageFromProcessor
{
    use ReasonTrait;

    public function __construct($reason)
    {
        $this->setReason($reason);
    }

    public function type()
    {
        return 'job.reject';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobRejectMessage($this);
    }
}
