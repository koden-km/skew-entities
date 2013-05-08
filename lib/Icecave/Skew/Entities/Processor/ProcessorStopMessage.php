<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Collections\Set;

class ProcessorStartMessage extends AbstractProcessorMessage implements DaemonToProcessorMessageInterface
{
    public function type()
    {
        return 'Processor.stop';
    }

    public function capabilities()
    {
        return $this->capabilities;
    }

    public function setCapabilities($capabilities)
    {
        $this->capabilities->clear();
        $this->capabilities->unionInPlace($capabilities);
    }

    public abstract function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorStopMessage($this);
    }

    private $capabilities = new Set;
}
