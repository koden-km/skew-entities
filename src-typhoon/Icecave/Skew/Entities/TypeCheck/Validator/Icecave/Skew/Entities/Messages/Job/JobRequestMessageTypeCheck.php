<?php
namespace Icecave\Skew\Entities\TypeCheck\Validator\Icecave\Skew\Entities\Messages\Job;

class JobRequestMessageTypeCheck extends \Icecave\Skew\Entities\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 2) {
            if ($argumentCount < 1) {
                throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('jobId', 0, 'string');
            }
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('task', 1, 'string');
        } elseif ($argumentCount > 2) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(2, $arguments[2]);
        }
        $value = $arguments[0];
        if (!\is_string($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'jobId',
                0,
                $arguments[0],
                'string'
            );
        }
        $value = $arguments[1];
        if (!\is_string($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'task',
                1,
                $arguments[1],
                'string'
            );
        }
    }

    public function type(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function accept(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('visitor', 0, 'Icecave\\Skew\\Entities\\Messages\\VisitorInterface');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

}
