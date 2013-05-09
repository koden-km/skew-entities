<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Skew\Entities\ProcessorMessageInterface;
use Icecave\Skew\Entities\VisitorInterface;

class ProcessorShutdownMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function type()
    {
        return 'processor.shutdown';
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorShutdownMessage($this);
    }
}
