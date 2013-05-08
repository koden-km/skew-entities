<?php
namespace Icecave\Skew\Entities\Job;

class JobRequestMessage extends AbstractJobMessage
{
    use ReasonTrait;

    public function __construct($reason)
    {
        $this->setJob($reason);
    }
}
