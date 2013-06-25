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

class Parser
{
    public function __construct(ConstraintInterface $constraint)
    {
        $this->reader = new ValidatingReader(
            new BoundConstraintValidator(
                $constraint,
                new DefaultingConstraintValidator
            )
        );
    }

    public function parse($message)
    {
        $value = $this->reader->readString($message);
        $messageType = $value->type->value();

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
        }

        return $this->setCommonProperties($value, $message);
    }

    private function setCommonProperties(ObjectValue $value, MessageInterface $message)
    {
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

        return $message;
    }

    private function createJobAcceptMessage(ObjectValue $value)
    {
        return new JobAcceptMessage(
            $value->retry->value()
        );
    }

    private function createJobCompleteMessage(ObjectValue $value)
    {
        return new JobCompleteMessage;
    }

    private function createJobErrorMessage(ObjectValue $value)
    {
        return new JobErrorMessage(
            $value->reason->value(),
            $value->retry->value()
        );
    }

    private function createJobLogMessage(ObjectValue $value)
    {
        return new JobLogMessage(
            LogLevel::instanceByValue($value->level->value()),
            $value->message->value()
        );
    }

    private function createJobProgressMessage(ObjectValue $value)
    {
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

    private function createJobRejectMessage(ObjectValue $value)
    {
        return new JobRejectMessage(
            $value->reason->value()
        );
    }

    private function createJobRequestMessage(ObjectValue $value)
    {
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

    private function createProcessorReadyMessage(ObjectValue $value)
    {
        return new ProcessorReadyMessage;
    }

    private function createProcessorShutdownMessage(ObjectValue $value)
    {
        return new ProcessorShutdownMessage;
    }

    private function createProcessorStartMessage(ObjectValue $value)
    {
        $message = new ProcessorStartMessage;
        $message->setCapabilities($value->capabilities->value());

        return $message;
    }

    private function createProcessorStopMessage(ObjectValue $value)
    {
        return new ProcessorStopMessage;
    }

    private $reader;
}
