<?php
namespace Icecave\Skew\Entities\Job;

class JobAcceptMessage extends AbstractJobMessageFromProcessor
{
    public function type()
    {
        return 'job.accept';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobAcceptMessage($this);
    }
}
