<?php
namespace Icecave\Skew\Entities\Job;

class JobCompleteMessage extends AbstractJobMessageFromProcessor
{
    public function type()
    {
        return 'job.complete';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobCompleteMessage($this);
    }
}
