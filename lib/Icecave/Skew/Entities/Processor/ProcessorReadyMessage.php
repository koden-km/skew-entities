<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Skew\Entities\ProcessorMessageInterface;
use Icecave\Skew\Entities\VisitorInterface;

class ProcessorReadyMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function type()
    {
        return 'processor.ready';
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorReadyMessage($this);
    }
}
