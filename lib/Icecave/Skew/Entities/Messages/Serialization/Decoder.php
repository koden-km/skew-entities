<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\Job\JobAcceptMessage;
use Icecave\Skew\Entities\Messages\Job\JobAwareMessageInterface;
use Icecave\Skew\Entities\Messages\Job\JobCompleteMessage;
use Icecave\Skew\Entities\Messages\Job\JobErrorMessage;
use Icecave\Skew\Entities\Messages\Job\JobLogMessage;
use Icecave\Skew\Entities\Messages\Job\JobProgressMessage;
use Icecave\Skew\Entities\Messages\Job\JobRejectMessage;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\Messages\Job\LogLevel;
use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\Messages\Processor\ProcessorAwareMessageInterface;
use Icecave\Skew\Entities\Messages\Processor\ProcessorReadyMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorShutdownMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStartMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStopMessage;
use Icecave\Skew\Entities\Priority;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;
use InvalidArgumentException;
use stdClass;

class Decoder
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    public function decode(stdClass $inputMessage)
    {
        $this->typeCheck->decode(func_get_args());

        if ('job.accept' === $inputMessage->type) {
            $outputMessage = $this->createJobAcceptMessage($inputMessage);
        } elseif ('job.complete' === $inputMessage->type) {
            $outputMessage = $this->createJobCompleteMessage($inputMessage);
        } elseif ('job.error' === $inputMessage->type) {
            $outputMessage = $this->createJobErrorMessage($inputMessage);
        } elseif ('job.log' === $inputMessage->type) {
            $outputMessage = $this->createJobLogMessage($inputMessage);
        } elseif ('job.progress' === $inputMessage->type) {
            $outputMessage = $this->createJobProgressMessage($inputMessage);
        } elseif ('job.reject' === $inputMessage->type) {
            $outputMessage = $this->createJobRejectMessage($inputMessage);
        } elseif ('job.request' === $inputMessage->type) {
            $outputMessage = $this->createJobRequestMessage($inputMessage);
        } elseif ('processor.ready' === $inputMessage->type) {
            $outputMessage = $this->createProcessorReadyMessage($inputMessage);
        } elseif ('processor.shutdown' === $inputMessage->type) {
            $outputMessage = $this->createProcessorShutdownMessage($inputMessage);
        } elseif ('processor.start' === $inputMessage->type) {
            $outputMessage = $this->createProcessorStartMessage($inputMessage);
        } elseif ('processor.stop' === $inputMessage->type) {
            $outputMessage = $this->createProcessorStopMessage($inputMessage);
        } else {
            throw new InvalidArgumentException('Invalid message type.');
        }

        $this->setCommonProperties($inputMessage, $outputMessage);

        return $outputMessage;
    }

    /**
     * @param stdClass         $inputMessage
     * @param MessageInterface $outputMessage
     */
    private function setCommonProperties(stdClass $inputMessage, MessageInterface $outputMessage)
    {
        $this->typeCheck->setCommonProperties(func_get_args());

        if ($outputMessage instanceof JobAwareMessageInterface && property_exists($inputMessage, 'job')) {
            $outputMessage->setJobId($inputMessage->job);
        }

        if ($outputMessage instanceof ProcessorAwareMessageInterface && property_exists($inputMessage, 'processor')) {
            $outputMessage->setProcessor($inputMessage->processor);
        }
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobAcceptMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobAcceptMessage(func_get_args());

        return new JobAcceptMessage($inputMessage->retry);
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobCompleteMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobCompleteMessage(func_get_args());

        return new JobCompleteMessage;
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobErrorMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobErrorMessage(func_get_args());

        return new JobErrorMessage(
            $inputMessage->reason,
            $inputMessage->retry
        );
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobLogMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobLogMessage(func_get_args());

        return new JobLogMessage(
            LogLevel::instanceByValue($inputMessage->level),
            $inputMessage->message
        );
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobProgressMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobProgressMessage(func_get_args());

        if (property_exists($inputMessage, 'status')) {
            $status = $inputMessage->status;
        } else {
            $status = null;
        }

        return new JobProgressMessage($inputMessage->progress, $status);
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobRejectMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobRejectMessage(func_get_args());

        return new JobRejectMessage($inputMessage->reason);
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createJobRequestMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createJobRequestMessage(func_get_args());

        $message = new JobRequestMessage(
            $inputMessage->job,
            $inputMessage->task
        );

        $message->setPriority(
            Priority::instanceByValue($inputMessage->priority)
        );

        $message->setTags($inputMessage->tags);
        $message->setPayload($inputMessage->payload);

        return $message;
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createProcessorReadyMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createProcessorReadyMessage(func_get_args());

        return new ProcessorReadyMessage;
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createProcessorShutdownMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createProcessorShutdownMessage(func_get_args());

        return new ProcessorShutdownMessage;
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createProcessorStartMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createProcessorStartMessage(func_get_args());

        $message = new ProcessorStartMessage;
        $message->setCapabilities($inputMessage->capabilities);

        return $message;
    }

    /**
     * @param stdClass $inputMessage
     *
     * @return MessageInterface
     */
    private function createProcessorStopMessage(stdClass $inputMessage)
    {
        $this->typeCheck->createProcessorStopMessage(func_get_args());

        return new ProcessorStopMessage;
    }

    private $typeCheck;
    private $reader;
}
