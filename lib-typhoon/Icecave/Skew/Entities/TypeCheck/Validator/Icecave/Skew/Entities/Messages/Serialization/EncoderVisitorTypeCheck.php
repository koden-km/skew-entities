<?php
namespace Icecave\Skew\Entities\TypeCheck\Validator\Icecave\Skew\Entities\Messages\Serialization;

class EncoderVisitorTypeCheck extends \Icecave\Skew\Entities\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function visitJobAcceptMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobAcceptMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobCompleteMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobCompleteMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobErrorMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobErrorMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobLogMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobLogMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobProgressMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobProgressMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobRejectMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobRejectMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitJobRequestMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobRequestMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitProcessorReadyMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Processor\\ProcessorReadyMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitProcessorShutdownMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Processor\\ProcessorShutdownMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitProcessorStartMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Processor\\ProcessorStartMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function visitProcessorStopMessage(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\Processor\\ProcessorStopMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function createObject(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('message', 0, 'Icecave\\Skew\\Entities\\Messages\\MessageInterface');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

}
