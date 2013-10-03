<?php
namespace Icecave\Skew\Entities\Messages\Job;

trait RetryTrait
{
    /**
     * @return boolean True if the job is allowed to be retried.
     */
    public function retry()
    {
        return $this->retry;
    }

    /**
     * @param boolean $retry True if the job is allowed to be reretried.
     */
    public function setRetry($retry)
    {
        $this->retry = $retry;
    }

    private $retry = false;
}
