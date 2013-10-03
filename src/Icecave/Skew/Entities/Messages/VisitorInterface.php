<?php
namespace Icecave\Skew\Entities\Messages;

interface VisitorInterface
{
    /**
     * @param Job\JobAcceptMessage $message
     *
     * @return mixed
     */
    public function visitJobAcceptMessage(Job\JobAcceptMessage $message);

    /**
     * @param Job\JobCompleteMessage $message
     *
     * @return mixed
     */
    public function visitJobCompleteMessage(Job\JobCompleteMessage $message);

    /**
     * @param Job\JobErrorMessage $message
     *
     * @return mixed
     */
    public function visitJobErrorMessage(Job\JobErrorMessage $message);

    /**
     * @param Job\JobLogMessage $message
     *
     * @return mixed
     */
    public function visitJobLogMessage(Job\JobLogMessage $message);

    /**
     * @param Job\JobProgressMessage $message
     *
     * @return mixed
     */
    public function visitJobProgressMessage(Job\JobProgressMessage $message);

    /**
     * @param Job\JobRejectMessage $message
     *
     * @return mixed
     */
    public function visitJobRejectMessage(Job\JobRejectMessage $message);

    /**
     * @param Job\JobRequestMessage $message
     *
     * @return mixed
     */
    public function visitJobRequestMessage(Job\JobRequestMessage $message);

    /**
     * @param Processor\ProcessorReadyMessage $message
     *
     * @return mixed
     */
    public function visitProcessorReadyMessage(Processor\ProcessorReadyMessage $message);

    /**
     * @param Processor\ProcessorShutdownMessage $message
     *
     * @return mixed
     */
    public function visitProcessorShutdownMessage(Processor\ProcessorShutdownMessage $message);

    /**
     * @param Processor\ProcessorStartMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStartMessage(Processor\ProcessorStartMessage $message);

    /**
     * @param Processor\ProcessorStopMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStopMessage(Processor\ProcessorStopMessage $message);
}
