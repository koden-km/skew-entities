<?php
namespace Icecave\Skew\Entities\Job;

trait ReasonTrait
{
    public function reason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    private $reason;
}
