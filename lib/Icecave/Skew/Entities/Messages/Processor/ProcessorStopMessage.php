<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\DaemonToProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class ProcessorStopMessage extends AbstractProcessorMessage implements DaemonToProcessorMessageInterface
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'processor.stop';
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitProcessorStopMessage($this);
    }

    private $typeCheck;
}
