<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Eloquent\Schemer\Constraint\ConstraintInterface;
use Eloquent\Schemer\Reader\ValidatingReader;
use Eloquent\Schemer\Validation\BoundConstraintValidator;
use Eloquent\Schemer\Validation\DefaultingConstraintValidator;
use Eloquent\Schemer\Value\ObjectValue;
use Icecave\Skew\Entities\Messages\Job\AbstractJobMessage;
use Icecave\Skew\Entities\Messages\Job\AbstractJobMessageFromProcessor;
use Icecave\Skew\Entities\Messages\Job\JobAcceptMessage;
use Icecave\Skew\Entities\Messages\Job\JobCompleteMessage;
use Icecave\Skew\Entities\Messages\Job\JobErrorMessage;
use Icecave\Skew\Entities\Messages\Job\JobLogMessage;
use Icecave\Skew\Entities\Messages\Job\JobProgressMessage;
use Icecave\Skew\Entities\Messages\Job\JobRejectMessage;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\Messages\Job\LogLevel;
use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\Messages\Processor\AbstractProcessorMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorReadyMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorShutdownMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStartMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStopMessage;
use Icecave\Skew\Entities\Priority;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;
use InvalidArgumentException;

class Parser
{
    /**
     * @param ConstraintInterface $constraint
     */
    public function __construct(ConstraintInterface $constraint)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->reader = new ValidatingReader(
            new BoundConstraintValidator(
                $constraint,
                new DefaultingConstraintValidator
            )
        );
    }

    /**
     * @param string $message
     *
     * @return MessageInterface
     */
    public function parse($message)
    {
        $this->typeCheck->parse(func_get_args());

        $value = $this->reader->readString($message);
        $messageType = $value->getRawDefault('type');

        if ('job.accept' === $messageType) {
            $message = $this->createJobAcceptMessage($value);
        } elseif ('job.complete' === $messageType) {
            $message = $this->createJobCompleteMessage($value);
        } elseif ('job.error' === $messageType) {
            $message = $this->createJobErrorMessage($value);
        } elseif ('job.log' === $messageType) {
            $message = $this->createJobLogMessage($value);
        } elseif ('job.progress' === $messageType) {
            $message = $this->createJobProgressMessage($value);
        } elseif ('job.reject' === $messageType) {
            $message = $this->createJobRejectMessage($value);
        } elseif ('job.request' === $messageType) {
            $message = $this->createJobRequestMessage($value);
        } elseif ('processor.ready' === $messageType) {
            $message = $this->createProcessorReadyMessage($value);
        } elseif ('processor.shutdown' === $messageType) {
            $message = $this->createProcessorShutdownMessage($value);
        } elseif ('processor.start' === $messageType) {
            $message = $this->createProcessorStartMessage($value);
        } elseif ('processor.stop' === $messageType) {
            $message = $this->createProcessorStopMessage($value);
        } else {
            throw new InvalidArgumentException('Invalid message type.');
        }

        $this->setCommonProperties($value, $message);

        return $message;
    }

    /**
     * @param ObjectValue      $value
     * @param MessageInterface $message
     */
    private function setCommonProperties(ObjectValue $value, MessageInterface $message)
    {
        $this->typeCheck->setCommonProperties(func_get_args());

        if ($message instanceof AbstractJobMessage) {
            if ($value->has('job')) {
                $message->setJobId($value->job->value());
            }
        }

        if ($message instanceof AbstractProcessorMessage || $message instanceof AbstractJobMessageFromProcessor) {
            if ($value->has('processor')) {
                $message->setProcessor($value->processor->value());
            }
        }
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobAcceptMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobAcceptMessage(func_get_args());

        return new JobAcceptMessage(
            $value->retry->value()
        );
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobCompleteMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobCompleteMessage(func_get_args());

        return new JobCompleteMessage;
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobErrorMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobErrorMessage(func_get_args());

        return new JobErrorMessage(
            $value->reason->value(),
            $value->retry->value()
        );
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobLogMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobLogMessage(func_get_args());

        return new JobLogMessage(
            LogLevel::instanceByValue($value->level->value()),
            $value->message->value()
        );
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobProgressMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobProgressMessage(func_get_args());

        if ($value->has('status')) {
            $status = $value->status->value();
        } else {
            $status = null;
        }

        return new JobProgressMessage(
            $value->progress->value(),
            $status
        );
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobRejectMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobRejectMessage(func_get_args());

        return new JobRejectMessage(
            $value->reason->value()
        );
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createJobRequestMessage(ObjectValue $value)
    {
        $this->typeCheck->createJobRequestMessage(func_get_args());

        $message =  new JobRequestMessage(
            $value->job->value(),
            $value->task->value()
        );

        $message->setPriority(
            Priority::instanceByValue($value->priority->value())
        );

        $message->setTags($value->tags->value());
        $message->setPayload($value->payload->value());

        return $message;
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createProcessorReadyMessage(ObjectValue $value)
    {
        $this->typeCheck->createProcessorReadyMessage(func_get_args());

        return new ProcessorReadyMessage;
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createProcessorShutdownMessage(ObjectValue $value)
    {
        $this->typeCheck->createProcessorShutdownMessage(func_get_args());

        return new ProcessorShutdownMessage;
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createProcessorStartMessage(ObjectValue $value)
    {
        $this->typeCheck->createProcessorStartMessage(func_get_args());

        $message = new ProcessorStartMessage;
        $message->setCapabilities($value->capabilities->value());

        return $message;
    }

    /**
     * @param ObjectValue $value
     *
     * @return MessageInterface
     */
    private function createProcessorStopMessage(ObjectValue $value)
    {
        $this->typeCheck->createProcessorStopMessage(func_get_args());

        return new ProcessorStopMessage;
    }

    private $typeCheck;
    private $reader;
}
