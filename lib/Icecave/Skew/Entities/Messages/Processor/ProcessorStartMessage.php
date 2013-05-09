<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\ProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class ProcessorStartMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->capabilities = new Set;
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'processor.start';
    }

    /**
     * @return Set<string> The set of task names that the processor is capable of executing.
     */
    public function capabilities()
    {
        $this->typeCheck->capabilities(func_get_args());

        return $this->capabilities;
    }

    /**
     * @param mixed<string> $capabilities The set of task names that the processor is capable of executing.
     */
    public function setCapabilities($capabilities)
    {
        $this->typeCheck->setCapabilities(func_get_args());

        $this->capabilities->clear();
        $this->capabilities->unionInPlace($capabilities);
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitProcessorStartMessage($this);
    }

    private $typeCheck;
    private $capabilities;
}
