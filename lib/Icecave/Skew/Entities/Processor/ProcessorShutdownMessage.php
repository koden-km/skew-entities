<?php
namespace Icecave\Skew\Entities\Processor;

class ProcessorShutdownMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function type()
    {
        return 'Processor.shutdown';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorShutdownMessage($this);
    }
}
