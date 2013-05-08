<?php
namespace Icecave\Skew\Entities\Processor;

class ProcessorReadyMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function type()
    {
        return 'Processor.ready';
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorReadyMessage($this);
    }
}
