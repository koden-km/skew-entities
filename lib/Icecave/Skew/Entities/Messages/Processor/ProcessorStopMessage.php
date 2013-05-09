<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\DaemonToProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;

class ProcessorStopMessage extends AbstractProcessorMessage implements DaemonToProcessorMessageInterface
{
    public function type()
    {
        return 'processor.stop';
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorStopMessage($this);
    }
}
