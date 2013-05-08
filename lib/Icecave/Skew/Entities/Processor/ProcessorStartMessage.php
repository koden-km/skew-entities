<?php
namespace Icecave\Skew\Entities\Processor;

class ProcessorStopMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function type()
    {
        return 'Processor.start';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorStartMessage($this);
    }
}
