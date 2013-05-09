<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;

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
