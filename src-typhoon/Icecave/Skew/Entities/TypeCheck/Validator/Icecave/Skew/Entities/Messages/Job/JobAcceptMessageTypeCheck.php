<?php
namespace Icecave\Skew\Entities\TypeCheck\Validator\Icecave\Skew\Entities\Messages\Job;

class JobAcceptMessageTypeCheck extends \Icecave\Skew\Entities\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount > 1) {
            throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        if ($argumentCount > 0) {
            $value = $arguments[0];
            if (!\is_bool($value)) {
                throw new \Icecave\Skew\Entities\TypeCheck\Exception\UnexpectedArgumentValueException(
                    'retry',
                    0,
                    $arguments[0],
                    'boolean'
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
