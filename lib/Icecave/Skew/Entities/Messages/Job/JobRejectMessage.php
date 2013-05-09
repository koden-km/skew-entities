<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;

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
