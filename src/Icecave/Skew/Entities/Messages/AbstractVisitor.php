<?php
namespace Icecave\Skew\Entities\Messages;

use Icecave\Skew\Entities\TypeCheck\TypeCheck;
use LogicException;

abstract class AbstractVisitor implements VisitorInterface
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());
    }

    /**
     * @param Job\JobAcceptMessage $message
     *
     * @return mixed
     */
    public function visitJobAcceptMessage(Job\JobAcceptMessage $message)
    {
        $this->typeCheck->visitJobAcceptMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobCompleteMessage $message
     *
     * @return mixed
     */
    public function visitJobCompleteMessage(Job\JobCompleteMessage $message)
    {
        $this->typeCheck->visitJobCompleteMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobErrorMessage $message
     *
     * @return mixed
     */
    public function visitJobErrorMessage(Job\JobErrorMessage $message)
    {
        $this->typeCheck->visitJobErrorMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobLogMessage $message
     *
     * @return mixed
     */
    public function visitJobLogMessage(Job\JobLogMessage $message)
    {
        $this->typeCheck->visitJobLogMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobProgressMessage $message
     *
     * @return mixed
     */
    public function visitJobProgressMessage(Job\JobProgressMessage $message)
    {
        $this->typeCheck->visitJobProgressMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobRejectMessage $message
     *
     * @return mixed
     */
    public function visitJobRejectMessage(Job\JobRejectMessage $message)
    {
        $this->typeCheck->visitJobRejectMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Job\JobRequestMessage $message
     *
     * @return mixed
     */
    public function visitJobRequestMessage(Job\JobRequestMessage $message)
    {
        $this->typeCheck->visitJobRequestMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Processor\ProcessorReadyMessage $message
     *
     * @return mixed
     */
    public function visitProcessorReadyMessage(Processor\ProcessorReadyMessage $message)
    {
        $this->typeCheck->visitProcessorReadyMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Processor\ProcessorShutdownMessage $message
     *
     * @return mixed
     */
    public function visitProcessorShutdownMessage(Processor\ProcessorShutdownMessage $message)
    {
        $this->typeCheck->visitProcessorShutdownMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Processor\ProcessorStartMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStartMessage(Processor\ProcessorStartMessage $message)
    {
        $this->typeCheck->visitProcessorStartMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param Processor\ProcessorStopMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStopMessage(Processor\ProcessorStopMessage $message)
    {
        $this->typeCheck->visitProcessorStopMessage(func_get_args());

        return $this->visitMessage($message);
    }

    /**
     * @param MessageInterface $message
     *
     * @throws LogicException
     */
    protected function visitMessage(MessageInterface $message)
    {
        $this->typeCheck->visitMessage(func_get_args());

        throw new LogicException('Visitor "' . get_class($this) . '" can not visit message type "' . $message->type() . '".');
    }

    private $typeCheck;
}
