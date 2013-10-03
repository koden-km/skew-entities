<?php
namespace Icecave\Skew\Entities\Messages\Job;

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
