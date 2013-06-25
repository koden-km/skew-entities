<?php
namespace Icecave\Skew\Entities;

use PHPUnit_Framework_TestCase;

class PriorityTest extends PHPUnit_Framework_TestCase
{
    public function testCompare()
    {
        $this->assertTrue(Priority::HIGH()->isEqualTo(Priority::HIGH()));
        $this->assertTrue(Priority::NORMAL()->isLessThan(Priority::HIGH()));
        $this->assertTrue(Priority::LOW()->isLessThan(Priority::HIGH()));

        $this->assertTrue(Priority::HIGH()->isGreaterThan(Priority::NORMAL()));
        $this->assertTrue(Priority::NORMAL()->isEqualTo(Priority::NORMAL()));
        $this->assertTrue(Priority::LOW()->isLessThan(Priority::NORMAL()));

        $this->assertTrue(Priority::HIGH()->isGreaterThan(Priority::LOW()));
        $this->assertTrue(Priority::NORMAL()->isGreaterThan(Priority::LOW()));
        $this->assertTrue(Priority::LOW()->isEqualTo(Priority::LOW()));
    }

    public function testCompareFailure()
    {
        $this->setExpectedException('Icecave\Parity\Exception\NotComparableException');
        Priority::HIGH()->compare(3);
    }
}
