<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageFromProcessor
{
    public function __construct($progress = 0.0)
    {
        $this->setProgress($progress);
    }

    public function type()
    {
        return 'job.progress';
    }

    public function progress()
    {
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobProgressMessage($this);
    }

    private $progress;
}
