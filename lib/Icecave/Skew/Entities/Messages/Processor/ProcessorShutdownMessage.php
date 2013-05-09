<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\ProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;

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
