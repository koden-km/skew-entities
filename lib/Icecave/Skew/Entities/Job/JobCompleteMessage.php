<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\VisitorInterface;

class JobCompleteMessage extends AbstractJobMessageFromProcessor
{
    public function type()
    {
        return 'job.complete';
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobCompleteMessage($this);
    }
}
