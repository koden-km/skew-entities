<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\Job\AbstractJobMessage;
use Icecave\Skew\Entities\Messages\Job\AbstractJobMessageFromProcessor;
use Icecave\Skew\Entities\Messages\Job\JobAcceptMessage;
use Icecave\Skew\Entities\Messages\Job\JobCompleteMessage;
use Icecave\Skew\Entities\Messages\Job\JobErrorMessage;
use Icecave\Skew\Entities\Messages\Job\JobLogMessage;
use Icecave\Skew\Entities\Messages\Job\JobProgressMessage;
use Icecave\Skew\Entities\Messages\Job\JobRejectMessage;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\Messages\Processor\AbstractProcessorMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorReadyMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorShutdownMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStartMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStopMessage;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;
use stdClass;

class EncoderVisitor implements VisitorInterface
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());
    }

    /**
     * @param JobAcceptMessage $message
     *
     * @return mixed
     */
    public function visitJobAcceptMessage(JobAcceptMessage $message)
    {
        $this->typeCheck->visitJobAcceptMessage(func_get_args());

        $object = $this->createObject($message);
        $object->retry = $message->retry();

        return $object;
    }

    /**
     * @param JobCompleteMessage $message
     *
     * @return mixed
     */
    public function visitJobCompleteMessage(JobCompleteMessage $message)
    {
        $this->typeCheck->visitJobCompleteMessage(func_get_args());

        return $this->createObject($message);
    }

    /**
     * @param JobErrorMessage $message
     *
     * @return mixed
     */
    public function visitJobErrorMessage(JobErrorMessage $message)
    {
        $this->typeCheck->visitJobErrorMessage(func_get_args());

        $object = $this->createObject($message);
        $object->reason = $message->reason();
        $object->retry = $message->retry();

        return $object;
    }

    /**
     * @param JobLogMessage $message
     *
     * @return mixed
     */
    public function visitJobLogMessage(JobLogMessage $message)
    {
        $this->typeCheck->visitJobLogMessage(func_get_args());

        $object = $this->createObject($message);
        $object->level = $message->level()->value();
        $object->message = $message->message();

        return $object;
    }

    /**
     * @param JobProgressMessage $message
     *
     * @return mixed
     */
    public function visitJobProgressMessage(JobProgressMessage $message)
    {
        $this->typeCheck->visitJobProgressMessage(func_get_args());

        $object = $this->createObject($message);
        $object->progress = $message->progress();

        if (null !== $message->status()) {
            $object->status = $message->status();
        }

        return $object;
    }

    /**
     * @param JobRejectMessage $message
     *
     * @return mixed
     */
    public function visitJobRejectMessage(JobRejectMessage $message)
    {
        $this->typeCheck->visitJobRejectMessage(func_get_args());

        $object = $this->createObject($message);
        $object->reason = $message->reason();

        return $object;
    }

    /**
     * @param JobRequestMessage $message
     *
     * @return mixed
     */
    public function visitJobRequestMessage(JobRequestMessage $message)
    {
        $this->typeCheck->visitJobRequestMessage(func_get_args());

        $object = $this->createObject($message);
        $object->priority = $message->priority()->value();
        $object->task = $message->task();
        $object->payload = $message->payload();
        $object->tags = $message->tags()->elements();

        return $object;
    }

    /**
     * @param ProcessorReadyMessage $message
     *
     * @return mixed
     */
    public function visitProcessorReadyMessage(ProcessorReadyMessage $message)
    {
        $this->typeCheck->visitProcessorReadyMessage(func_get_args());

        return $this->createObject($message);
    }

    /**
     * @param ProcessorShutdownMessage $message
     *
     * @return mixed
     */
    public function visitProcessorShutdownMessage(ProcessorShutdownMessage $message)
    {
        $this->typeCheck->visitProcessorShutdownMessage(func_get_args());

        return $this->createObject($message);
    }

    /**
     * @param ProcessorStartMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStartMessage(ProcessorStartMessage $message)
    {
        $this->typeCheck->visitProcessorStartMessage(func_get_args());

        $object = $this->createObject($message);
        $object->capabilities = $message->capabilities()->elements();

        return $object;
    }

    /**
     * @param ProcessorStopMessage $message
     *
     * @return mixed
     */
    public function visitProcessorStopMessage(ProcessorStopMessage $message)
    {
        $this->typeCheck->visitProcessorStopMessage(func_get_args());

        return $this->createObject($message);
    }

    /**
     * @param MessageInterface $message
     *
     * @return stdClass
     */
    protected function createObject(MessageInterface $message)
    {
        $this->typeCheck->createObject(func_get_args());

        $object = new stdClass;
        $object->type = $message->type();

        // Include job ID for any job related messages ...
        if ($message instanceof AbstractJobMessage) {
            if (null !== $message->jobId()) {
                $object->job = $message->jobId();
            }
        }

        // Includ ethe processor ID for any messages originating from processors ...
        if ($message instanceof AbstractProcessorMessage || $message instanceof AbstractJobMessageFromProcessor) {
            if (null !== $message->processor()) {
                $object->processor = $message->processor();
            }
        }

        return $object;
    }

    private $typeCheck;
}
