<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\VisitorInterface;

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

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobRejectMessage($this);
    }
}
