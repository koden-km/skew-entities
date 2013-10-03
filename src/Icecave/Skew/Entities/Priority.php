<?php
namespace Icecave\Skew\Entities;

use Eloquent\Enumeration\Enumeration;
use Icecave\Parity\Exception\NotComparableException;
use Icecave\Parity\ExtendedComparableInterface;
use Icecave\Parity\ExtendedComparableTrait;
use Icecave\Parity\RestrictedComparableInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Priority extends Enumeration implements ExtendedComparableInterface, RestrictedComparableInterface
{
    use ExtendedComparableTrait;

    const HIGH   = 'high';
    const NORMAL = 'normal';
    const LOW    = 'low';

    /**
     * @param mixed $value The value to compare.
     *
     * @return integer                The result of the comparison.
     * @throws NotComparableException Indicates that the implementation does not know how to compare $this to $value.
     */
    public function compare($value)
    {
        TypeCheck::get(__CLASS__)->compare(func_get_args());

        if ($this === $value) {
            return 0;
        } elseif (!$this->canCompare($value)) {
            throw new NotComparableException($this, $value);
        }

        return $this->numericPriority() - $value->numericPriority();
    }

    /**
     * Check if $this is able to be compared to another value.
     *
     * A return value of false indicates that calling $this->compare($value)
     * will throw an exception.
     *
     * @param mixed $value The value to compare.
     *
     * @return boolean True if $this can be compared to $value.
     */
    public function canCompare($value)
    {
        TypeCheck::get(__CLASS__)->canCompare(func_get_args());

        return $value instanceof self;
    }

    /**
     * @return integer A numeric representation of the priority.
     */
    public function numericPriority()
    {
        TypeCheck::get(__CLASS__)->numericPriority(func_get_args());

        if (Priority::HIGH() === $this) {
            return +1;
        } elseif (Priority::LOW() === $this) {
            return -1;
        }

        return 0;
    }
}
