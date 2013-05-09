<?php
namespace Icecave\Skew\Entities\TypeCheck\Validator\Icecave\Skew\Entities;

class JobTypeCheck extends \Icecave\Skew\Entities\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 2) {
            if ($argumentCount < 1) {
                throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('id', 0, 'string');
            }
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('task', 1, 'string');
        } elseif ($argumentCount > 2) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(2, $arguments[2]);
        }
        $value = $arguments[0];
        if (!\is_string($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'id',
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

    public function fromRequest(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('request', 0, 'Icecave\\Skew\\Entities\\Messages\\Job\\JobRequestMessage');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function id(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setId(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('id', 0, 'string');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        $value = $arguments[0];
        if (!\is_string($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'id',
                0,
                $arguments[0],
                'string'
            );
        }
    }

    public function task(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setTask(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('task', 0, 'string');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        $value = $arguments[0];
        if (!\is_string($value)) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'task',
                0,
                $arguments[0],
                'string'
            );
        }
    }

    public function payload(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setPayload(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('payload', 0, 'mixed');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
    }

    public function tags(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function setTags(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\MissingArgumentException('tags', 0, 'mixed<string>');
        } elseif ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        $value = $arguments[0];
        $check = function ($value) {
            if (!\is_array($value) && !$value instanceof \Traversable) {
                return false;
            }
            foreach ($value as $key => $subValue) {
                if (!\is_string($subValue)) {
                    return false;
                }
            }
            return true;
        };
        if (!$check($arguments[0])) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                'tags',
                0,
                $arguments[0],
                'mixed<string>'
            );
        }
    }

}
