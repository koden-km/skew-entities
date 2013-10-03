<?php
namespace Icecave\Skew\Entities\Messages\Processor;

interface ProcessorAwareMessageInterface
{
    /**
     * @return string
     */
    public function processor();

    /**
     * @param string $processor
     */
    public function setProcessor($processor);
}
