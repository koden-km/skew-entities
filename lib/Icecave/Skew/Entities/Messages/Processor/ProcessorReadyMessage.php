<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\ProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;

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
