<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Skew\Entities\DaemonToProcessorMessageInterface;
use Icecave\Skew\Entities\VisitorInterface;

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
