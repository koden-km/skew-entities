<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;

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
