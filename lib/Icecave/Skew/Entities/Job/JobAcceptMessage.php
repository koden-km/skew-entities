<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\VisitorInterface;

class JobAcceptMessage extends AbstractJobMessageFromProcessor
{
    public function type()
    {
        return 'job.accept';
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobAcceptMessage($this);
    }
}
