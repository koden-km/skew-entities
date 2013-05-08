<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageWithWorker
{
    public function __construct($progress = 0.0)
    {
        $this->setProgress($progress);
    }

    public function progress()
    {
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    private $progress;
}
