<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobLogMessage extends AbstractJobMessageFromProcessor
{
    /**
     * @param LogLevel $level   The severity of the log entry.
     * @param string   $message Human-readable log message.
     */
    public function __construct(LogLevel $level, $message)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setLevel($level);
        $this->setMessage($message);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.log';
    }

    /**
     * @return LogLevel The severity of the log entry.
     */
    public function level()
    {
        $this->typeCheck->level(func_get_args());

        return $this->level;
    }

    /**
     * @param LogLevel $level The severity of the log entry.
     */
    public function setLevel(LogLevel $level)
    {
        $this->typeCheck->setLevel(func_get_args());

        $this->level = $level;
    }

    /**
     * @return string Human-readable log message.
     */
    public function message()
    {
        $this->typeCheck->message(func_get_args());

        return $this->message;
    }

    /**
     * @param string $message Human-readable log message.
     */
    public function setMessage($message)
    {
        $this->typeCheck->setMessage(func_get_args());

        $this->message = $message;
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobLogMessage($this);
    }

    private $typeCheck;
    private $level;
    private $message;
}
