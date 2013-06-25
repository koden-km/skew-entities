<?php
namespace Icecave\Skew\Entities\TypeCheck\Validator\Icecave\Skew\Entities\Messages\Job;

class JobProgressMessageTypeCheck extends \Icecave\Skew\Entities\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount > 2) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(2, $arguments[2]);
        }
        if ($argumentCount > 0) {
            $value = $arguments[0];
            if (!\is_float($value)) {
                throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                    'progress',
                    0,
                    $arguments[0],
                    'float'
                );
            }
        }
        if ($argumentCount > 1) {
            $value = $arguments[1];
            if (!(\is_string($value) || $value === null)) {
                throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                    'status',
                    1,
                    $arguments[1],
                    'string|null'
                );
            }
        }
    }

    public function type(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function progress(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setProgress(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('progress', 0, 'float');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        $value = $arguments[0];
        if (!\is_float($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'progress',
                0,
                $arguments[0],
                'float'
            );
        }
    }

    public function status(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setStatus(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('status', 0, 'string|null');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        $value = $arguments[0];
        if (!(\is_string($value) || $value === null)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'status',
                0,
                $arguments[0],
                'string|null'
            );
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
