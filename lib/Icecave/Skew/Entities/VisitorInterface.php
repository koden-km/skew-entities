<?php
namespace Icecave\Skew\Entities\VisitorInterface;

interface VisitorInterface
{
    public function visitJobAcceptMessage(Job\JobAcceptMessage $message);
    public function visitJobCompleteMessage(Job\JobCompleteMessage $message);
    public function visitJobErrorMessage(Job\JobErrorMessage $message);
    public function visitJobLogMessage(Job\JobLogMessage $message);
    public function visitJobProgressMessage(Job\JobProgressMessage $message);
    public function visitJobRejectMessage(Job\JobRejectMessage $message);
    public function visitJobRequestMessage(Job\JobRequestMessage $message);
    public function visitProcessorReadyMessage(Processor\ProcessorReadyMessage $message);
    public function visitProcessorShutdownMessage(Processor\ProcessorShutdownMessage $message);
    public function visitProcessorStartMessage(Processor\ProcessorStartMessage $message);
    public function visitProcessorStopMessage(Processor\ProcessorStopMessage $message);
}
