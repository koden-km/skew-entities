<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageFromProcessor
{
    public function __construct(LogLevel $level, $message)
    {
        $this->setLevel($level);
        $this->setMessage($message);
    }

    public function type()
    {
        return 'job.log';
    }

    public function level()
    {
        return $this->level;
    }

    public function setLevel(Level $level)
    {
        $this->level = $level;
    }

    public function message()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitJobLogMessage($this);
    }

    private $level;
    private $message;
}
