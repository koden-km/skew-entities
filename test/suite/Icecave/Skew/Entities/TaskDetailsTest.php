<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use PHPUnit_Framework_TestCase;
use stdClass;

class TaskDetailsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->taskDetails = new TaskDetails('skew.test');
    }

    public function testFromRequest()
    {
        $payload = new stdClass;

        $request = new JobRequestMessage('123', 'skew.test');
        $request->setTags(['tag1', 'tag2']);
        $request->setPayload($payload);

        $taskDetails = TaskDetails::fromRequest($request);

        $this->assertInstanceOf(__NAMESPACE__ . '\TaskDetails', $taskDetails);
        $this->assertSame('skew.test', $taskDetails->task());
        $this->assertEquals(new Set(['tag1', 'tag2']), $taskDetails->tags());
        $this->assertSame($payload, $taskDetails->payload());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetPriority()
    {
        $this->assertSame(Priority::NORMAL(), $this->taskDetails->priority());
        $this->taskDetails->setPriority(Priority::HIGH());
        $this->assertSame(Priority::HIGH(), $this->taskDetails->priority());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetTask()
    {
        $this->assertSame('skew.test', $this->taskDetails->task());
        $this->taskDetails->setTask('skew.other');
        $this->assertSame('skew.other', $this->taskDetails->task());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetTags()
    {
        $this->assertEquals(new Set, $this->taskDetails->tags());
        $this->taskDetails->setTags(['tag1', 'tag2']);
        $this->assertEquals(new Set(['tag1', 'tag2']), $this->taskDetails->tags());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetPayload()
    {
        $payload = new stdClass;
        $this->assertNull($this->taskDetails->payload());
        $this->taskDetails->setPayload($payload);
        $this->assertSame($payload, $this->taskDetails->payload());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testCopyTaskDetails()
    {
        $payload = new stdClass;

        $this->taskDetails->setPriority(Priority::HIGH());
        $this->taskDetails->setPayload($payload);
        $this->taskDetails->setTags(['tag1', 'tag2']);

        $taskDetails = new TaskDetails('foo');
        $taskDetails->copyTaskDetails($this->taskDetails);

        $this->assertSame('skew.test', $taskDetails->task());
        $this->assertSame(Priority::HIGH(), $taskDetails->priority());
        $this->assertSame($payload, $taskDetails->payload());
        $this->assertEquals(new Set(['tag1', 'tag2']), $taskDetails->tags());
    }
}
