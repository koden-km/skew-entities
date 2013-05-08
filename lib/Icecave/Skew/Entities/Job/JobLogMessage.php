<?php
namespace Icecave\Skew\Entities\Job;

class JobErrorMessage extends AbstractJobMessageWithWorker
{
    public function __construct(LogLevel $level, $message)
    {
        $this->setLevel($level);
        $this->setMessage($message);
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

    private $level;
    private $message;
}
